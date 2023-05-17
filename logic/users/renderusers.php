<?php

function renderusers($db)
{
    
    $conn=$db;

    // Initialize the session
    session_start();

    // Check if user is an Admin
    if($_SESSION["role"] != 1)
    {
        header("Location: /panel");
    }

    // Prepare select statement
    $sql = "SELECT username,role FROM users";
    $stmt = $conn->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Print users
    foreach($users as $user)
    {       

        if ($user['role']==1)
        {
            $role="admin";
        }
        
        else
        {
            $role="user";
        }

        if($user["username"] == "admin" || $user["username"] == $_SESSION["username"]) 
        {
            $del=null;
        }

        else
        {
            $del="<td>
            <form action='/userdel' method='post'>
            <button class='btn btn-danger' name ='user' value='$user[username]'> Delete </button>
            </form>
            </td>";
        }
        
        echo "
        <tr>
        <td>$user[username]</td>";
        echo "
        <td>$role</td>";
        if($user['username']!='admin' && $user['username'] != $_SESSION["username"])
        {
            echo "
            <td>
            <form action='/changerole' method='post' style='display: inline;'>
            <input type='hidden' name='newrole' value="; if($user['role']==0){echo 1;}else{echo 0;} echo">
            <button class='btn btn-primary' name ='user' value='$user[username]'>"; if($role=='admin'){echo "Downgrade to user";}else{echo "Promote to admin";} echo "</button>
            </form>
            </td>";
        }
        else
        {
            echo"<td></td>";
        }

        if($_SESSION["username"]=="admin")
        {
            echo"
            <td>
            <form action='/changepass' method='post'>
            <input type='password' name='pass'>
            <button class='btn btn-primary' name ='user' value='$user[username]'> Update password </button>
            </form>
            </td>
            $del
            </tr>";
        }
        else
        {
            if($user['username']!="admin")
            {
            echo"
            <td>
            <form action='/changepass' method='post'>
            <input type='password' name='pass'>
            <button class='btn btn-primary' name ='user' value='$user[username]'> Update password </button>
            </form>
            </td>
            $del
            </tr>";
            }
        }
        
            
    }

}