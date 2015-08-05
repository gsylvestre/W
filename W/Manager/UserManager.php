<?php

namespace W\Manager;

class UserManager extends Manager
{

	/**
	 * Récupère un utilisateur en fonction de son email ou de son pseudo
	 */
	public function getUserByUsernameOrEmail($usernameOrEmail)
	{

		global $app;

		$sql = "SELECT * FROM " . $app->getConfig('security_user_table') . 
				" WHERE " . $app->getConfig('security_usernameProperty') . " = :username OR " . 
				$app->getConfig('security_emailProperty') . " = :email LIMIT 1";
		$dbh = ConnectionManager::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(":username", $usernameOrEmail);
		$sth->bindValue(":email", $usernameOrEmail);
		if ($sth->execute()){
			$foundUser = $sth->fetch();
			if ($foundUser){
				return $foundUser;
			}
		}

		return false;
	}

}