
#!/usr/bin/php
<?php
/*
Class MAKEpasswd:
Make password from selected characters in a string.
required arguments:
length of a password and characters to use in a password.

1 = a - z
2 = A - Z
3 = a - z and A - Z
4 = a - z, A - Z and 0 - 9
5 = a - z, A - Z, 0 - 9 and chars !#$%&()

usage:
Make 10 passwords that is 8 characters long and
includes characters a - z, A - Z, 0 - 9 and !#$%&()

$numTimes = 0;
$example = new MAKEpasswd(8,5);
while($numTimes < 10)
{
       print($example->makePassword() . "<br>\n");
       $numTimes++;
}
*/
class MAKEpasswd
{
       var $intLength;
       var $pool;

       function MAKEpasswd($iLength, $iChars)
       {
               $this->intLength = $iLength;
               $this->pool = $this->getPool($iChars);
       }
       function getPool($iChars)
       {
               switch($iChars)
               {
                       case 1: /* a - z */
                               for($i = 0x61; $i <= 0x7A; $i++)
                               {
                                       $str .= chr($i);
                               }
                               return $str;
                               break;
                       case 2: /* A - Z */
                               for($i = 0x41; $i <= 0x5A; $i++)
                               {
                                       $str .= chr($i);
                               }
                               return $str;
                               break;
                       case 3: /* a - z and A - Z */
                               $str = $this->getPool(1);
                               $str .= $this->getPool(2);
                               return $str;
                               break;
                       case 4: /* 0 - 9, A - Z and a - z */
                           $str = $this->getPool(3); // get chars a - z and A - Z first
                               for($i = 0x30; $i <= 0x39; $i++)
                               {
                                       $str .= chr($i); // add chars 0 - 9;
                               }
                               return $str;
                               break;
                       case 5:
                               /* This will add these chars into the string !#$%&() */
                               $str = $this->getPool(4);
                               for($i = 0x21; $i < 0x29; $i++)
                               {
                                       if($i == 0x22 || $i == 0x27) // Exclude characters " and '
                                       {
                                               continue;
                                       }
                                       $str .= chr($i);
                               }
                               return $str;
                               break;
               }
       }
       function makePassword()
       {
               srand ((double) microtime() * 1000000);
               $str="";
               while(strlen($str)< $this->intLength)
               {
                       $str.=$this->pool[rand()%strlen($this->pool)];
               }
               return $str ;
       }
}

$numTimes = 0;
$example = new MAKEpasswd(8,5);
while($numTimes < 10)
{
       print($example->makePassword() . "<br>\n");
       $numTimes++;
}

?>
