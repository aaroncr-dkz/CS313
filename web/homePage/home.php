<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width">
    <title>Home | Operation Find My Food</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div id="container">
        <header>
            <h1>Operation: Find My Food</h1>
        </header>

        <nav></nav>

        <main>
            <p>They say breakfast is the most important meal of the day... I disagree. For the college student lunchtime is critical. Do you go home? But that takes time. Do you pack a lunch? Probably. But you just get tired of eating sandwiches and frozen burritoes every day. Instead, the Crossroads has deals, but you never know what they are, and you've seen you of those student vendors in your building, but you wonder how many others there are on campus? But who's going to go on a scavenger hunt for that? That's what <strong>Operation: Find My Food</strong> is concerned with. And here to fix.</p>

            <section>
                <h2>The Crossroads</h2>
                <p><em>The Crossroads</em> is located on the second floor of the Manwaring Center (probably the only notable piece of information there was what MC stood for). Each day, they have a food deal for one of the providers there in the food court. Students can usually see these in their student advisory emails, near the bottom. But who actualy reads those.</p>

                <div id="crossroad-area">
                    <table id="calander">
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td onmouseenter="displayDeal(0)" onmouseout="removeDeal()">1</td>
                            <td onmouseenter="displayDeal(1)" onmouseout="removeDeal()">2</td>
                            <td onmouseenter="displayDeal(2)" onmouseout="removeDeal()">3</td>
                            <td onmouseenter="displayDeal(3)" onmouseout="removeDeal()">4</td>
                            <td>5</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td onmouseenter="displayDeal(4)" onmouseout="removeDeal()">7</td>
                            <td onmouseenter="displayDeal(5)" onmouseout="removeDeal()">8</td>
                            <td onmouseenter="displayDeal(6)" onmouseout="removeDeal()">9</td>
                            <td onmouseenter="displayDeal(7)" onmouseout="removeDeal()">10</td>
                            <td onmouseenter="displayDeal(8)" onmouseout="removeDeal()">11</td>
                            <td>12</td>
                        </tr>

                        <tr>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                        </tr>

                        <tr>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                        </tr>

                        <tr>
                            <td>27</td>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <div id="deal-box">
                        <img id="deal-pic" src="">
                        <p id="deal-text"></p>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <?php
            echo "Last Updated: " . date("d F Y", getlastmod());
            ?>
        </footer>
    </div>
    <script src="script.js" type="text/javascript"></script>
</body>

</html>
