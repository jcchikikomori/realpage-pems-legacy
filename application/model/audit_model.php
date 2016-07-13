<?php

class AuditModel
{    
    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            $ERROR = "The database was either unable to connect or doesn't exists.<hr /><b>DEBUG:</b> " . $e . "<hr />";
            require_once '_fb/error.html';
            exit;
        }
    }
    
    public function set_log($type, $description) {
        $sql = "INSERT INTO audit_trail (id, type, description, user, account_type, user_provider, ip_address, UA, date)
                VALUES (:id, :type, :description, :user, :account_type, :user_provider, :ip_address, :UA, :date)";
        $query = $this->db->prepare($sql);
        
        if ($_SERVER['REMOTE_ADDR'] != '::1') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = 'Not Available';
        }
        
        $browser = new Browser();
        $UA = $browser->getUserAgent();
        
        $parameters = array(
            ':id' => UUID::v4(),
            ':type' => $type,
            ':description' => $description,
            ':user' => Session::get('user_name'),
            ':account_type' => Session::get('user_account_type'),
            ':user_provider' => Session::get('user_provider_type'),
            ':ip_address' => $ip,
            ':UA' => $UA,
            ':date' => time()
        );
        //$query->execute($parameters);
        try { $query->execute($parameters); } catch (PDOException $e) {
            $_SESSION["feedback_negative"][] = AT_UNABLE_TO_LOG . ( ENVIRONMENT != 'release' ? " Error: " . $e->getMessage() : "Please Contact Administrator for details" );
        }
    }
    
    public function get_log($id) {
        $sql = "SELECT * FROM audit_trail
                WHERE id = :id
                ORDER BY date DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
    }
    
    public function get_logs($mode = NULL) {
        $sql = "SELECT * FROM audit_trail
                ORDER BY date DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        //json output
        if (!empty($mode) && $mode == 'json') {
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
            //init array
            $result = [];
            foreach ($fetch as $row) {
                $result[] = [
                    'id' => $row['id'],
                    'type' => $row['type'],
                    'description' => $row['description'],
                    'user' => $row['user'],
                    'ip_address' => $row['ip_address'],
                    'UA' => $row['UA'],
                    'date' => date(DATE_DDMMYY, $row['date'])
                ];
            }
            //this will also end inside this class
            Helper::encode($result, 'json');
            return true;
        } else {
            $fetch = $query->fetchAll();
            if (empty($fetch)) {
                $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
                return false;
            } else {
                return $fetch;
            }
        }
    }
    
    public function count_logs()
    {
        $sql = "SELECT COUNT(*) AS audit_count FROM audit_trail";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->audit_count;
    }
}

