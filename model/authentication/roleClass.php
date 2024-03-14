<?php
class roleClass {
    //put your code here
    public function fetchMenu() {
        $log = Logger::getLogger('|| 7DW ||');
        include '../../controller/config/dbConnection.php';
        $queryMenu = "SELECT * FROM f_menu_detail";
        //$log->debug("Query excuted : $queryMenu");
        $result = $con->query($queryMenu);
        while ($row = mysqli_fetch_array($result)) {
            $menu[] = $row['menu_id'];
        }
        return $menu;
        mysqli_close($con);
    }
    
    public function createRole($id, $role, $description, $user) {
        $log = Logger::getLogger('|| 7DW ||');
        include '../../controller/config/dbConnection.php';
        $queryInsert = "insert into f_user_role(role_id, role_name, role_description, created_by, created_date)
                values('{$id}','{$role}','{$description}','{$user}', NOW())";
        $method = $this->fetchMenu();

        foreach ($method as $v) {
            $queryMenuMap = "INSERT INTO f_role_menu_mapping(role_id, menu_id, created_by, created_date) VALUES('{$id}', '{$v}', '{$user}', NOW())";
            $log->debug("Query excuted : $queryMenuMap");
            $con->query($queryMenuMap);
        }
        $log->debug("Query excuted : $queryInsert");
        $result = $con->query($queryInsert);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
        mysqli_close($con);
    }

    public function editRole($id, $role, $description, $user) {
        $log = Logger::getLogger('|| 7DW ||');
        include '../../controller/config/dbConnection.php';
        $queryInsert = "update f_user_role SET role_name='{$role}', role_description='{$description}', updated_by='{$user}', updated_date=NOW() WHERE role_id='{$id}'";
        $log->debug("Query excuted : $queryInsert");
        $result = $con->query($queryInsert);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
        mysqli_close($con);
    }

    public function assignMenu($role, $menu) {
        $log = Logger::getLogger('|| 7DW ||');
        include '../../controller/config/dbConnection.php';
        $fecthMenu = $this->fetchMenu();
        //$i=0;
        $result1 = array_intersect($fecthMenu, $menu);
        $result2 = array_diff($fecthMenu, $menu);
        //echo "$value===$menu[$i]";
        //$log->info("$value===$menu[$i]");
        foreach ($result1 as $value) {
            $queryAssign = "UPDATE f_role_menu_mapping SET status=1 WHERE role_id='{$role}' AND menu_id='{$value}'";
            $log->info("Query assign excuted as : $queryAssign");
            $result = $con->query($queryAssign);
        }
        foreach ($result2 as $val) {
            $queryAssign = "UPDATE f_role_menu_mapping SET status=0 WHERE role_id='{$role}' AND menu_id='{$val}'";
            $log->info("Query assign excuted as : $queryAssign");
            $result = $con->query($queryAssign);
        }
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function addUser($username, $password, $name, $email, $contact, $designation, $country, $role, $region,  $plant, $branchId, $state, $district, $postOffice, $address) {

        $log = Logger::getLogger('|| 7DW ||');
        include '../../controller/config/dbConnection.php';
        $encPass = sha1($password);
        $queryInsert="INSERT INTO f_user_detail (
                                            user_id
                                           ,name
                                           ,branch_id
                                           ,address
                                           ,post
                                           ,district
                                           ,state
                                           ,country
                                           ,email
                                           ,contact
                                           ,designation
                                           ,c_by
                                           ,c_date
                                         ) VALUES (
                                            '{$username}' -- user_id - IN varchar(20)
                                           ,'{$name}' -- name - IN varchar(50)
                                           ,'{$branchId}' -- branch_id - IN varchar(100)
                                           ,'{$address}' -- address - IN varchar(200)
                                           ,'{$postOffice}'  -- post - IN varchar(20)
                                           ,'{$district}'  -- district - IN varchar(20)
                                           ,'{$state}'  -- state - IN varchar(20)
                                           ,'{$country}'  -- country - IN varchar(20)
                                           ,'{$email}' -- email - IN varchar(200)
                                           ,'{$contact}'  -- contact - IN varchar(30)
                                           ,'{$designation}'  -- designation - IN varchar(50)
                                           ,'{$_SESSION['uid']}'  -- c_by - IN varchar(20)
                                           ,NOW() -- c_date - IN timestamp
                                         )";
        
        
        
        /*$queryInsert = "insert into f_user_detail(user_id, name, email, contact, designation, c_by, branch_id, c_date)
                values('{$username}','{$name}', '{$email}', '{$contact}', '{$designation}', '{$user}', '{$branchId}', NOW())";*/
        $queryInsertC = "insert into f_user_credential(user_id, password, role, created_by, created_date)
                values('{$username}','{$encPass}','{$role}', '{$_SESSION['uid']}', NOW())";
        $log->debug("Query excuted : $queryInsert");
        $log->debug("Query excuted Cred : $queryInsertC");
        $result = $con->query($queryInsert);
        $resultC = $con->query($queryInsertC);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
        mysqli_close($con);
    }

    public function updateUser($id, $name, $email, $contact, $designation, $country, $state, $district, $address, $postOffice, $branchId, $role) {

        $log = Logger::getLogger('|| 7DW ||');
        include '../../controller/config/dbConnection.php';
        $queryInsert="UPDATE f_user_detail SET
                                            name = '{$name}' -- varchar(50)
                                           ,branch_id = '{$branchId}' -- varchar(100)
                                           ,address = '{$address}' -- varchar(200)
                                           ,post = '{$postOffice}' -- varchar(20)
                                           ,district = '{$district}' -- varchar(20)
                                           ,state = '{$state}' -- varchar(20)
                                           ,country = '{$country}' -- varchar(20)
                                           ,email = '{$email}' -- varchar(200)
                                           ,contact = '{$contact}' -- varchar(30)
                                           ,designation = '{$designation}' -- varchar(50)
                                           ,u_by = '{$_SESSION['uid']}' -- varchar(20)
                                           ,u_date = NOW() -- datetime
                                         WHERE user_id = '{$id}' -- varchar(20)";
        /*$queryInsert = "UPDATE f_user_detail SET name='{$name}', email='{$email}', contact='{$contact}', designation='{$designation}', u_by='{$user}', u_date=NOW() WHERE user_id='{$username}'";*/
        $queryInsertC = "UPDATE f_user_credential SET role='{$role}', updated_by='{$_SESSION['uid']}', updated_date=NOW() WHERE user_id='{$id}'";
        $log->debug("Query update excuted : $queryInsert");
        $log->debug("Query update excuted Cred : $queryInsertC");
        $result = $con->query($queryInsert);
        $resultC = $con->query($queryInsertC);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
        mysqli_close($con);
    }

    public function fetchUser($role, $plant) {
        include '../../controller/config/dbConnection.php';
        $log = Logger::getLogger('|| 7DW ||');
        if ($role === 'ROL001') {
            $queryCat = "SELECT * FROM f_user_detail as ud, f_user_credential as uc where ud.user_id = uc.user_id AND uc.status='1'";
        } else {
            $queryCat = "SELECT * FROM f_user_detail as ud, f_user_credential as uc where ud.user_id = uc.user_id AND uc.plant='{$plant}' AND uc.status='1'";
        }
        $log->info("Query Select User : $queryCat");
        $selectResult = $con->query($queryCat);
        $role = array();
        $i = 0;
        while ($row = mysqli_fetch_array($selectResult)) {
            $role[] = array(
                'sid' => $row['id'],
                'id' => $row['user_id'],
                'role' => $row['role'],
                'name' => $row['name'],
                'email' => $row['email'],
                'date' => $row['created_date'],
                'by' => $row['created_by'],
            );
            //$i++;
        }
        mysqli_close($con);
        return $role;
    }

    public function fetchRole() {
        include '../../controller/config/dbConnection.php';
        $log = Logger::getLogger('|| 7DW ||');
        $queryCat = "select * from f_user_role";
        $selectResult = $con->query($queryCat);
        $role = array();
        $i = 0;
        while ($row = mysqli_fetch_array($selectResult)) {
            $role[] = array(
                'id' => $row['role_id'],
                'role' => $row['role_name'],
                'desc' => $row['role_description'],
                'status' => $row['status'],
                'date' => $row['created_date'],
                'by' => $row['created_by']
            );
            //$i++;
        }
        mysqli_close($con);
        return $role;
        
    }
}
?>