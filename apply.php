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
        
        <form method="post" action="http://mercury.swin.edu.au/it000000/formtest.php">
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
                    <input type="text" name="firstname" id="firstname" maxlength="20" required>
                
                <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" maxlength="20" required>
                
                <label for="dob">Date Of Birth:</label>
                    <input type="date" name="dob" id="dob" required>
                <h2>Gender </h2>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                    
                    <input type="radio" id="female" name="gender" value="female" required>
                    <label for="female">Female</label>
                    
                    <input type="radio" id="other" name="gender" value="other" required>
                    <label for="other">Other</label> <br/> <br/>
                <label for="streetaddress">Street Address:</label>
                    <input type="text" name="streetaddress" id="streetaddress" maxlength="40" required>
                
                <label for="suburb">Suburb/Town:</label>
                    <input type="text" name="suburb" id="suburb" maxlength="40">
                
                <label for="state">State:</label>
                <select name="state" id="state">
                    <option value="qld">QLD</option>
                    <option value="nsw">NSW</option>
                    <option value="vic">VIC</option>
                    <option value="nt">NT</option>
                    <option value="wa">WA</option>
                    <option value="sa">SA</option>
                    <option value="act">ACT</option>
                    <option value="tas">TAS</option>
                </select>
            </fieldset>

        <!---CONTACT DETAILS-->
            
            <fieldset>
                <legend>Contact Details</legend>
                    <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                
                <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" pattern="\d{8,12}" required>
            </fieldset>

        <!---skills-->
            <div class="skillsContainer">
                <fieldset> 
                    <legend>Skills</legend>
                    <label><input type="checkbox" name="skills" value="html" required> HTML</label><br>
                    <label><input type="checkbox" name="skills" value="css" required> CSS</label><br>
                    <label><input type="checkbox" name="skills" value="javascript" required> JavaScript</label><br>
                    <label><input type="checkbox" name="skills" value="python" required> Python</label><br>
                    <label><input type="checkbox" name="skills" value="java" required> Java</label><br>
                    <label><input type="checkbox" name="skills" value="sql" required> SQL</label><br>
                    <label><input type="checkbox" name="skills" value="git" required> Git</label><br>
                    <br />    
                </fieldset>
            </div>
        <label>Other Skills: <input type="text" name="other_skill"></label><br>
            <br>

        <div class="submitContainer"><input type="submit" value='Apply✅' class="applyInput"/></div>
        </form>
    </main>
    <?php include "footer.inc"; ?>
</body>
</html>

