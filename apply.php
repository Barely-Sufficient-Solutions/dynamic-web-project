<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Apply</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body id="applyBody">
    <?php include "header.inc"; ?>
    <main>
        <a class='jobsLink' href="jobs.html">See more about our positions</a>
        <h1 id="openPositionsTitle">Apply For Our Open Positions!</h1>
        <hr>
        
        <form action="./process_eoi.php" method="post">
            <fieldset>
                <legend>Job Reference Number</legend>
                <label for="referencenumber">Select a Job Reference Number:</label>
                <select name="referencenumber" id="referencenumber">
                    <option value="1">DA123</option>
                    <option value="2">SE456</option>
                </select>
            </fieldset>

            <!---PERSONAL DETAILS-->
            
            <fieldset>
                <legend>Personal Details</legend>
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname" maxlength="20">
                
                <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" maxlength="20">
                
                <label for="dob">Date Of Birth (dd/mm/yyyy):</label>
                    <input type="text" name="dob" id="dob">
                <h2>Gender </h2>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                    
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                    
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label> <br/> <br/>
                <label for="streetaddress">Street Address:</label>
                    <input type="text" name="streetaddress" id="streetaddress" maxlength="40">
                
                <label for="suburb">Suburb/Town:</label>
                    <input type="text" name="suburb" id="suburb" maxlength="40">
                
                <label for="state">State:</label>
                <select name="state" id="state">
                    <option selected disabled>Select:</option>
                    <option value="qld">QLD</option>
                    <option value="nsw">NSW</option>
                    <option value="vic">VIC</option>
                    <option value="nt">NT</option>
                    <option value="wa">WA</option>
                    <option value="sa">SA</option>
                    <option value="act">ACT</option>
                    <option value="tas">TAS</option>
                </select>
                <label for="postcode">Postcode:</label>
                <input type="text" name="postcode" id="postcode" maxlength="4">
            </fieldset>

        <!---CONTACT DETAILS-->
            
            <fieldset>
                <legend>Contact Details</legend>
                    <label for="email">Email:</label>
                <input type="email" name="email" id="email">
                
                <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" pattern="\d{8,12}">
            </fieldset>

        <!---skills-->
            <div class="skillsContainer">
                <fieldset> 
                    <legend>Skills</legend>
                    <label><input type="checkbox" name="html" value="html"> HTML</label><br>
                    <label><input type="checkbox" name="css" value="css"> CSS</label><br>
                    <label><input type="checkbox" name="javascript" value="javascript"> JavaScript</label><br>
                    <label><input type="checkbox" name="python" value="python"> Python</label><br>
                    <label><input type="checkbox" name="java" value="java"> Java</label><br>
                    <label><input type="checkbox" name="sql" value="sql"> SQL</label><br>
                    <label><input type="checkbox" name="git" value="git"> Git</label><br>
                    <br />    
                </fieldset>
            </div>
        <label>Other Skills (optional): <input type="text" name="other_skills"></label><br>
            <br>

        <div class="submitContainer"><input type="submit" value='Apply✅' class="applyInput"/></div>
        </form>
    </main>
    <?php include "footer.inc"; ?>
</body>
</html>

