<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <style>
        p{
            margin-top:3rem;
            text-align:center;
            text-decoration:underline;
            color:red;
            font-size:30px;
        }
        table{      
            width:48rem;
            height:15rem;
            padding:20px;
            margin-top:4%;
            margin-bottom:3%;
            box-shadow:2px 2px 10px black;
            border-radius:5px
        }
        td{
            font-size:2rem;
            font-weight:400;
            color:rgb(60,60,60);
            font-family:arial;
        }
        table input{
            width:80%;
            padding:7px;
            font-size:15px;
        }
        #btn{
            background:cyan;
            border:rgb(60,179,113);
            width:200%;
            padding:7px;
            font-weight:300;
            margin-left:23%;
            font-size:1.5rem;
        }
        #btn:hover{
            transition:0.5s;
            background-color:rgb(60,179,113);
        }
        #ok{
            color:black;
            text-decoration:none;
            font-size:20px;
        }
        #ok:hover{
            color:rgb(106,90,205);
            text-decoration:underline;
        }
        span{
            font-size:20px;
            margin-left:5%;
        }
        @media screen and (max-width:790px){
            table{
                width:35rem;
            }  
        }
        @media screen and (max-width:590px){
            table{
                width:30rem;
            }  
            p{
                font-size:1.4rem;
            }
            td{
                font-size:1.3rem;
            }
            #btn{
                font-size:1.3rem;
                width:270%;
            }
            #ok{
                font-size:15px;
            }
            span{
                font-size:15px;
            }
        }
        @media screen and (max-width:500px){
            table{
                width:25rem;
                padding:10px;
            }
        }
        @media screen and (max-width:420px){
            p{
                font-size:1.2rem;
            }
            td{
                font-size:1rem;
            }
            #btn{
                font-size:1rem;
                width:320%
            }
            table{
                margin-top:10%;
                width:90%;
            }
            #ok{
                font-size:14px;
            }
            span{
                font-size:15px;
            }
            table input{
                border:white;
                border-bottom:1px solid black;
            }
        }
        @media screen and (max-width:330px){
            #btn{
                width:270%;
            }
        }
    </style>
</head>
<body>
    <form  method="POST" >
        <p>FORGET PASSWORD</p>
        <table  align="center">   
            <tr colspan="2" align="center" >
                <td> <label for="email">E-mail</label> </td>
                <td>  <input type="email" name="un" id="email" required> </td>
            </tr>
            <tr colspan="2" align="center" >
                <td> <label for="username">Username</label> </td>
                <td>  <input type="text" name="cn" id="username" required> </td>
            </tr>
            <tr>  
                <td align="center"> 
                <button type="submit" id="btn" name="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>


<!-- PHP -->
<?php
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'myownproject') or die('Please check db');

if(isset($_POST['submit']))
{
    $un=$_POST['un'];
    $cn=$_POST['cn'];

    $query=mysqli_query($con, "select password from registration where email='$un' and name='$cn'") ;
    $ps=mysqli_fetch_array($query);
    if($ps>0)
    {   
        echo "<span>Your Password is : </span>".$ps['password'];
        echo"<br>";
        echo "<span>For <a href='../Account.php' id='ok'>Login</a></span>";
    }
    else
    {
        ?>
        <script>
            alert("Your Username is not exist");    
        </script>
        <?php
    }
}
?>