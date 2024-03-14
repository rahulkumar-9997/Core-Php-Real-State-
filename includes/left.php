<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $_SESSION['profile_pic']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p class="text-center"><?php echo $_SESSION['user']; ?></p>
              <a href="#"><i class="fa fa-circle text-success text-center"></i><?php echo $_SESSION['uid']; ?></a>
            </div>
          </div>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
                <?php
                //echo "Role ".$_SESSION['role'];
                //Set the database connection
                include '../../controller/config/dbConnection.php';
                //select all rows from the main_menu table
                $result = $con->query("select md.menu_id, md.menu_pid, md.menu_name, md.menu_url, md.menu_icon from f_role_menu_mapping as frm, f_menu_detail as md where frm.menu_id = md.menu_id and frm.role_id='{$_SESSION['role']}' AND status=1");
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
                function buildMenu($parent, $menu) {
                        $html = "";
                        if (isset($menu['parent_menus'][$parent])) {
                                foreach ($menu['parent_menus'][$parent] as $menu_id) {
                                        if (!isset($menu['parent_menus'][$menu_id])) {
                                                $html .= "<li><a href=". $menu['menus'][$menu_id]['menu_url'] . "?token=".$_REQUEST['token'].">" . $menu['menus'][$menu_id]['menu_icon'] . "<span>".$menu['menus'][$menu_id]['menu_name'] . "</span></a></li>";
                                        }
                                        if (isset($menu['parent_menus'][$menu_id])) {

                                                $html .= "<li class=\"treeview\" ><a href=\"#\">".$menu['menus'][$menu_id]['menu_icon']. "<span>".$menu['menus'][$menu_id]['menu_name'] ."</span>". "<i class=\"fa fa-angle-left pull-right\"></i></a>";
                                                $html .= "<ul class=\"treeview-menu\">";
                                                $html .= buildMenu($menu_id, $menu);
                                                $html .= "</ul>";
                                                $html .= "</li>";

                                        }
                                }
                        }
                        return $html;
                }
                ?>
          
            <?php echo buildMenu(0, $menu); ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>