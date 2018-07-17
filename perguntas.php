<!--	P1	-->
<p style="width:100%; clear:both;"><br><br><br><hr><p>
<div>
    <h2>Escreva um programa que imprima números de 1 a 100.</h2>
    <p>Mas, para múltiplos de 3 imprima “Fizz” em vez do número e para múltiplos de 5 imprima “Buzz”.
    <br>Para números múltiplos de ambos (3 e 5), imprima “FizzBuzz”.</p>
    <?php
    $string= "";
    for($i=1; $i<=100; $i++) {
    
        $flag_divisivel= false;
        $string.= ", ";
        if( ($i%3) == 0) {
            $string.= "Fizz";
            $flag_divisivel= true;
        }
        if( ($i%5) == 0) {
            $string.= "Buzz";
            $flag_divisivel= true;
        }
        if($flag_divisivel == false)
            $string.= $i;
    }
    echo substr( $string, 1 );
    ?>
</div>



<!--	P2	-->
<p style="width:100%; clear:both;"><br><br><br><hr><p>
<div>
    <h2>Refatore o código abaixo, fazendo as alterações que julgar necessário.</h2>
    <samp>
    ver fonte...
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            header("Location: http://www.google.com");
            exit();
        } elseif (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true) {
            header("Location: http://www.google.com");   
            exit();
        } ?>
    </samp>
    <code>
        <?php
        if(
            (
                 isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)
            ) || (
                 isset($_COOKIE['Loggedin']) ) && ($_COOKIE['Loggedin'] == true)
            )
        {
            header("Location: http://www.google.com");
            exit();
        } ?>
    </code>
</div>



<!--	P3	-->
<p style="width:100%; clear:both;"><br><br><br><hr><p>
<div>
    <h2>Refatore o código abaixo, fazendo as alterações que julgar necessário.</h2>
    <samp>
    ver fonte...
        <?php
        class MyUserClass    
        {    
            public function getUserList()    
            {    
                $dbconn = new DatabaseConnection('localhost','user','password');    
                $results = $dbconn->query('select name from user');    

                sort($results);    

                return $results;    
            }    
        }
        ?>
    </samp>
    <code>
        <?php
        class MyUserClass2    
        {    
            function getUserList2()    
            {    
                $dbconn = new DatabaseConnection('localhost','user','password');    
                $results = $dbconn->query('select name from user');    
                $lista= mysqli_fetch_all($results,MYSQLI_ASSOC);
                
                sort($lista);    

                return $results;    
            }    
        }
        ?>
    </code>
</div>