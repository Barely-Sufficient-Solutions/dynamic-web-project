<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include "header.inc"; ?>

    <main>
        <h1 class="mainTitle">About Us</h1>
        <div>
            <p>Here at Barely Sufficient Solutions, we believe in producing business solutions that are... barely sufficient...? Do not get your expectations overly high.</p>
            <p>Here is some information about the members of Barely Sufficient Solutions!</p>
            <div class="indexCards">
                <section class="indexPageCard data_analyst_card">
                    <div class="cardHeader"><h3>Class Info:</h3></div>
                    <div class="cardList">
                        <ul>
                            <li>Tutorial Week Date:</li>
                            <li class="indentText">Monday</li>
                            <li>Tutorial Time:</li>
                            <li class="indentText">2:30PM - 4:30PM</li>
                        </ul>
                    </div>
                </section>
                <section class="data_analyst_card indexPageCard">
                    <div class="cardHeader"><h3>Student IDs:</h3></div>
                    <ul class="cardList">
                        <li>Charlie Walker: 105933596</li>
                        <li>Ella Jaeger: <br/> 105872929</li>
                        <li>David Clonan: 105915439</li>
                    </ul>
                </section>
            </div>
        </div>
        <p>For BSS to run, we are managed by tutor <strong>Enrique Nicolás Ketterer!</strong></p>
        <section>
            <h2 class="mainTitle">Contributions</h2>
            <dl class="team">
                <div class="member">
                    <dt>Charlie</dt>
                    <dd>CSS styling, Jira management, Git repository, Index, template</dd>
                </div>
                <div class="member">
                    <dt>Ella</dt>
                    <dd>Jobs page, Apply page, CSS styling</dd>
                </div>
                <div class="member">
                    <dt>David</dt>
                    <dd>About page, some CSS</dd>
                </div>
            </dl>
        </section>
        <section>
            <h2 class="mainTitle">Group Photo</h2>
            <figure>
                <img class="groupPhoto" src=images/meettheteam-cropped.png alt="A photo of all three group members.">
                <figcaption>The group!</figcaption>
            </figure>
        </section>
        <section>
            <h2 class="mainTitle">About Each Member</h2>
            <table>
                <tr>
                    <th colspan="4">Members' Interests</th>
                </tr>
                <tr>
                    <th>Favourite:</th>
                    <th>Game</th>
                    <th>Movie</th>
                    <th>Hobby</th>
                </tr>
                <tr>
                    <th>Charlie</th>
                    <td>FIFA 15</td>
                    <td>Inglorious Bastards</td>
                    <td>Cooking</td>
                </tr>
                <tr>
                    <th>Ella</th>
                    <td>Legend of Zelda: Breath of the Wild</td>
                    <td>10 Things I Hate About You</td>
                    <td>Thrifting</td>
                </tr>
                <tr>
                    <th>David</th>
                    <td>Undertale</td>
                    <td>Oppenheimer</td>
                    <td>Game development</td>
                </tr>
            </table>
        </section>
    </main>

    <?php include "footer.inc"; ?>
</body>
</html>
