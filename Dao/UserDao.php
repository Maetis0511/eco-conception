<?php
/**
 * Gestionnaire de la classe user
 */
class userDao {

	/** Instance de PDO pour se connecter à la BD */
	private $_db;

	/**
	 * Connexion à la BDD
	 */
	public function __construct($db) {
        $this->setDb($db);
    }

	/**
	 * Recherche d'un utilisateur en ce basant sur le couple ident/mdp
	 */
    public function userExist($userId, $userPwd) {
        $sql = "SELECT userId FROM user WHERE userId = :userId AND userPwd = :userPwd";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([
            ':userId'  => $userId,
            ':userPwd' => $userPwd
        ]);

        return (bool) $stmt->fetchColumn();
    }

	/**
	 * Recherche de l'existance d'un id
	 */
    public function idExist($userId) {
        $sql = "SELECT userId FROM user WHERE userId = :userId";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([':userId' => $userId]);

        return (bool) $stmt->fetchColumn();
    }


   /**
    * Récupération de tous les users de la BDD
    */
    public function getList() {
        $users = [];

        $stmt = $this->_db->prepare('SELECT * FROM user');
        $stmt->execute();

        while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new user($donnees);
        }

        return $users;
    }


	/**
	 * Ajout d'un nouvel utilisateur à la BDD
	 */
   public function add($user) {
       $sql = 'INSERT INTO user(userId, userPwd) VALUES(:userId, :userPwd)';
       $stmt = $this->_db->prepare($sql);

       $stmt->execute([
           ':userId'  => $user->getUserId(),
           ':userPwd' => $user->getUserPwd()
       ]);
	}

    /**
	 * Modifieur sur l'instance pdo de connexion
	 */
     public function setDb(PDO $db) {
        $this->_db = $db;
    }

}
