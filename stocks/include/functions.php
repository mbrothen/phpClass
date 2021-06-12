<?php

class Stock{
    function getTopNav(){
        ?>
        <ul>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?">Home</a></li>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?t=reset">Reset</a></li>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?t=stocks">Get Stocks</a></li>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?t=view">View Stocks</a></li>
        </ul>
        <?php

    }

    function getFooter(){
        ?>
        <footer>Copyright 2021 Amazzzing Stocks Page Co</footer>
        <?php
    }

    function getHeader(){
        #$title = '<h1>Amazzzing Stocks</h1>';
        #return "<div class = 'header'>" . $title . "</div>";
        ?>
            <div class = 'header'>
                <h1>Amazzzing Stocks</h1>
            </div>
        <?php
    }

    function showStocks($rows) {

        ?>
        <table>
        <thead>
            <th>Number</th>
            <th>Company</th>
            <th>Symbol</th>
            <th>Sector</th>
            <th>Price ($)</th>
        </thead>
        <tbody>
        <?php
        /*
        #while($rs = $rows->fetch_array()) { $data[] = $rs; }
        $intCnt = 0;
        while($intCnt < count($rows)){

        $data = $rows[$intCnt];
        #$intCnt = count($data);*/
        $count = 1;
        ?>

        <?php foreach ($rows as $data) { ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $data["company"];?></td>
                <td> <?php echo $data["symbol"];?></td>
                <td> <?php echo $data["sector"];?></td>
                <td> <?php echo $data["price"];?></td>

            </tr>

        <?php
                $count += 1;
        }
        ?>
            </tbody>
        </table>
        <?php
    }
    function getStockFile($file){
            if(file_exists($file)){
                return true;
            }
            return false;
    }

    function ReadFile($file, $db){
            $result = $this->getStockFile($file);
            if($result){
                $stockList = fopen($file, 'r');

                while(!feof($stockList)){
                    $line = fgets($stockList);
                    $data = explode(";", $line);
                    if(!$db->insertRecord(TABLE_STOCK,$data)){
                        fclose($stockList);
                        return false;
                    }
                }
                fclose($stockList);
            }else {
                return false;
            }
            return true;
    }

}