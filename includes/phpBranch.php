<?php
 $selectBranchName="SELECT branch_name, district, country, state, pin_code, mobile_no, email, address, branch_code FROM branch WHERE branch_id='{$_SESSION['branch_id']}'";
        $branchResult=$con->query($selectBranchName);
        while ($branchRow = mysqli_fetch_array($branchResult)) {
            $brachName=$branchRow['branch_name'];
            $brachDistrict=$branchRow['district'];
            $brachCode=$branchRow['branch_code'];
            $branchDistrict=$branchRow['district'];
            $branchCountry=$branchRow['country'];
            $branchState=$branchRow['state'];
            $branchPinCode=$branchRow['pin_code'];
            $branchMobileNo=$branchRow['mobile_no'];
            $branchEmail=$branchRow['email'];
            $branchAddress=$branchRow['address'];

        }
?>