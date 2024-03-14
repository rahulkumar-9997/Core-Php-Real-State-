<?php
    include '../../logger/incLog.php';
    include_once '../../controller/config/dbConnection.php';
    $role = $_REQUEST['q'];
?>
<form action="../../controller/authentication/roleController.php" method="POST">
        <?php
            //echo "Role ".$_SESSION['role'];
            //Set the database connection
            include '../../controller/config/dbConnection.php';
            //select all rows from the main_menu table
            $result = $con->query("select md.menu_id, md.menu_pid, md.menu_name, md.menu_url, md.menu_icon, frm.status from f_role_menu_mapping as frm, f_menu_detail as md where frm.menu_id = md.menu_id and frm.role_id='{$role}'");
            //echo "select md.menu_id, md.menu_pid, md.menu_name, md.menu_url, md.menu_icon, frm.status from f_role_menu_mapping as frm, f_menu_detail as md where frm.menu_id = md.menu_id and frm.role_id='{$role}'";
            //create a multidimensional array to hold a list of menu and parent menu
            //echo "select md.menu_id, md.menu_pid, md.menu_name, md.menu_url, md.menu_icon from f_role_menu_mapping as frm, f_menu_detail as md where frm.id = md.id and frm.role_id='{$_SESSION['role']}'";
            $menu = array(
                    'menus' => array(),
                    'parent_menus' => array()
            );

            //build the array lists with data from the menu table
            while ($row = mysqli_fetch_assoc($result)) {
                    //creates entry into menus array with current menu id ie. $menus['menus'][1]
                    $menu['menus'][$row['menu_id']] = $row;
                    //creates entry into parent_menus array. parent_menus array contains a list of all menus with children
                    $menu['parent_menus'][$row['menu_pid']][] = $row['menu_id'];
            }

            // Create the main function to build milti-level menu. It is a recursive function.	
            function assignMenu($parent, $menu) {
                $html = "";
                if (isset($menu['parent_menus'][$parent])) {
                    $html .='<ul>';
                    foreach ($menu['parent_menus'][$parent] as $menu_id) {
                        if (!isset($menu['parent_menus'][$menu_id])) {
                            if($menu['menus'][$menu_id]['status']==='1'){
                                $html .= "<li><input type=\"checkbox\" checked name=\"assign[]\"  class=\"id\" value='".$menu['menus'][$menu_id]['menu_id']."' />"."&nbsp;<span>".$menu['menus'][$menu_id]['menu_name']."</span></li>";
                            }
                            else{
                                $html .= "<li><input type=\"checkbox\" name=\"assign[]\"  class=\"id\" value='".$menu['menus'][$menu_id]['menu_id']."' />"."&nbsp;<span>".$menu['menus'][$menu_id]['menu_name']."</span></li>";
                            }
                        }
                        if (isset($menu['parent_menus'][$menu_id])) {

                            //$html .= "<li><input type=\"checkbox\" name=\"assign[]\" value=".$menu['menus'][$menu_id]['menu_id']." />"."&nbsp;<span>".$menu['menus'][$menu_id]['menu_name']."</span>";
                            if($menu['menus'][$menu_id]['status']==='1'){
                                $html .= "<li><input type=\"checkbox\" checked name=\"assign[]\"  class=\"id\" value='".$menu['menus'][$menu_id]['menu_id']."' />"."&nbsp;<span>".$menu['menus'][$menu_id]['menu_name']."</span>";
                            }
                            else{
                                $html .= "<li><input type=\"checkbox\" name=\"assign[]\" class=\"id\" value='".$menu['menus'][$menu_id]['menu_id']."' />"."&nbsp;<span>".$menu['menus'][$menu_id]['menu_name']."</span>";
                            }
                                $html .= assignMenu($menu_id, $menu);
                                $html .= "</li>";

                        }
                    }
                        $html .= '</ul>';
                }
                return $html;
            }
        ?>
        <?php echo assignMenu(0, $menu); ?>
    <div class="col-lg-12">
        <input type="hidden" name="role_id" id="role_id" value="<?php echo $role ?>"/>
        <input type="hidden" name="action" value="assign"/>
        <input type="submit" name="submit" value="Save" class="btn btn-info center-block"/>
    </div>
</form>
<script>
        $(document).ready(function(){
            $('input[type=checkbox]').click(function(){
                //alert("hi");
                // if is checked
                if($(this).is(':checked')){
                    //alert("hi");
                    // check all children
                    $(this).parent().find('li input[type=checkbox]').prop('checked', true);
                    //alert("hi");
                    // check all parents
                    $(this).parent().prev().prop('checked', true);
                    //alert("hi");
                } else {
                    // uncheck all children
                    $(this).parent().find('li input[type=checkbox]').prop('checked', false);
                    //alert("hi");
                }

            });
    });
    </script>