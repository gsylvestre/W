<?php

	namespace W\Console;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;

	use Symfony\Component\Console\Question\Question;
	use Symfony\Component\Console\Question\ConfirmationQuestion;

	use W\Manager\ConnectionManager;

	class InstallCommand extends Command
	{
	    protected function configure()
	    {
	        $this
	            ->setName('w:install')
	            ->setDescription('Configure you app, install base tables for security system')
	        ;
	    }

	    protected function execute(InputInterface $input, OutputInterface $output)
	    {
	    	$helper = $this->getHelper('question');

	    	$configFile = __DIR__."/../../app/config.php";

	    	if (file_exists($configFile)){
	    		$output->writeln("\r\napp/config.php already exists.");
	    	}
	    	else {

		    	$output->writeln("\r\nURL SETUP");

		    	//url infos
		    	$question = new Question('Under which subfolder will run your app (ie "/my_app/test" if your app run under http://localhost/my_app/test/? ', '');
		    	$baseUrl = $helper->ask($input, $output, $question);
		    	//in case of mistakes
		    	$baseUrl = (substr($baseUrl, 0, 1) != '/') ? "/" . $baseUrl : $baseUrl;
		    	$baseUrl = (substr($baseUrl, -1) == '/') ? substr($baseUrl, 0, -1) : $baseUrl;


		    	$output->writeln("\r\nDATABASE CONNECTION SETUP");

		    	//db infos
		    	$question = new Question('Database name: ');
		    	$question->setValidator(function ($answer) {
		    	    if ($answer == "") {
		    	        throw new \RuntimeException(
		    	            'The database name is required !'
		    	        );
		    	    }
		    	    return $answer;
		    	});
		    	$question->setMaxAttempts(3);
		    	$dbName = $helper->ask($input, $output, $question);

		    	$question = new Question('Database host [localhost]: ', 'localhost');
		    	$dbHost = $helper->ask($input, $output, $question);

		    	$question = new Question('Database user [root]: ', 'root');
		    	$dbUser = $helper->ask($input, $output, $question);

		    	$question = new Question('Database password []: ', '');
		    	$dbPassword = $helper->ask($input, $output, $question);
		    	
		    	$question = new Question('Tables prefix (leave blank for none): ');
		    	$dbPrefix = $helper->ask($input, $output, $question);


		    	//user table name and fields
		    	$output->writeln("\r\nSECURITY SYSTEM SETUP");

		    	$question = new Question('What is your user\'s table name [users]: ', 'users');
				$tableName = $helper->ask($input, $output, $question);

		    	$question = new Question('What is your user\'s email field [email]: ', 'email');
				$emailField = $helper->ask($input, $output, $question);

		    	$question = new Question('What is your user\'s username field [username]: ', 'username');
				$usernameField = $helper->ask($input, $output, $question);

		    	$question = new Question('What is your user\'s password field [password]: ', 'password');
				$passwordField = $helper->ask($input, $output, $question);

		    	$question = new Question('What is your user\'s role field [role]: ', 'role');
				$roleField = $helper->ask($input, $output, $question);

				$output->writeln("\r\nWATCH OUT: YOUR CONFIG FILE WILL BE OVERWRITTEN !");
				$question = new ConfirmationQuestion('Continue with config.php and table creation? [y]', true);

				if (!$helper->ask($input, $output, $question)) {
				    return;
				}

		    	$configContent = '<?php 

	//url
	define("W_BASE_URL", "'.$baseUrl.'");

   	//database connection infos
	define("W_DB_HOST", "'.$dbHost.'");  
    define("W_DB_USER", "'.$dbUser.'");     
    define("W_DB_PASS", "'.$dbPassword.'");         
    define("W_DB_NAME", "'.$dbName.'"); 
    define("W_DB_TABLE_PREFIX", "'.$dbPrefix.'");

	//user authentification
	define("W_DB_USER_TABLE", "'.$tableName.'");
	define("W_DB_USERNAME_PROPERTY", "'.$usernameField.'");
	define("W_DB_EMAIL_PROPERTY", "'.$emailField.'");
	define("W_DB_PASSWORD_PROPERTY", "'.$passwordField.'");
	define("W_DB_ROLE_PROPERTY", "'.$roleField.'");

    require("routes.php");
';

				if (file_put_contents($configFile, $configContent)){
					$output->writeln("<info>config.php created in /app/config.php !</info>");
				}
				else {
					$output->writeln("An error occured with config.php creation ! Aborting.");
					return false;
				}
			}

			include($configFile);
			$tableName = W_DB_USER_TABLE;
			$usernameField = W_DB_USERNAME_PROPERTY;
			$emailField = W_DB_EMAIL_PROPERTY;
			$passwordField = W_DB_PASSWORD_PROPERTY;
			$roleField = W_DB_ROLE_PROPERTY;

			$pdo = new \PDO("mysql:host=$dbHost", $dbUser, $dbPassword);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$pdo->query("CREATE DATABASE IF NOT EXISTS $dbName");

			$connectionManager = new ConnectionManager();
			$dbh = $connectionManager->getDbh();

			$results = $dbh->query("SHOW TABLES LIKE '$tableName'");
		    if(!$results) {
		        die(print_r($dbh->errorInfo(), TRUE));
		    }
		    if($results->rowCount()>0){
		    	$output->writeln("table $tableName already exists.");
		    }
		    else {
				$output->writeln("\r\nCreating $tableName table...");

				//user table creation
		    	$sql = "CREATE TABLE IF NOT EXISTS $tableName (
						  id int(11) NOT NULL,
						  $emailField varchar(255) NOT NULL,
						  $usernameField varchar(255) NOT NULL,
						  $passwordField varchar(255) NOT NULL,
						  $roleField varchar(255) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;
						ALTER TABLE $tableName ADD PRIMARY KEY (id);
						ALTER TABLE $tableName MODIFY id int(11) NOT NULL AUTO_INCREMENT;";

				
				$sth = $dbh->prepare($sql);

				if ($sth->execute()){
		        	$output->writeln("\r\nTable " . $tableName . " created!");
				}
				else {
		        	$output->writeln("\r\nTable " . $tableName . " NOT created!");
				}
		    }
		    $output->writeln("\r\nGood to go!");
	    }

	}