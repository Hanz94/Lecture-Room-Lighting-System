<!DOCTYPE>
<html>
    <head>
        <title>Schedule</title>
    </head>
    <body>
        <?php include 'header.php';
            //include 'connectarduino.php';
            require'maketable.php';
        ?>
        <div class="container">
            <div class="jumbotron">
                <form action="form.php" method="post">
                    <br>
                    <div class="panel panel-primary">
                    <div class="panel-heading">Monday</div>
                    <table class="table table-striped">
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Module name</th>
                        <th>Lecturer name</th>
                        <?php
                            echo $tablelist[0];
                        ?>
                    </table>
                    </div>
                    <br>
                    <div class="panel panel-primary">
                    <div class="panel-heading">Tuesday</div>
                    <table class="table table-striped">
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Module name</th>
                        <th>Lecturer name</th>
                        <?php
                            echo $tablelist[1];
                        ?>
                    </table>
                        </div>
                    <br>
                    <div class="panel panel-primary">
                    <div class="panel-heading">Wednesday</div>
                    <table class="table table-striped">
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Module name</th>
                        <th>Lecturer name</th>
                        <?php
                            echo $tablelist[2];
                        ?>
                    </table>
                        </div>
                    <br>
                    <div class="panel panel-primary">
                    <div class="panel-heading">Thursday</div>
                    <table class="table table-striped">
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Module name</th>
                        <th>Lecturer name</th>
                        <?php
                            echo $tablelist[3];
                        ?>
                    </table>
                        </div>
                    <br>
                    <div class="panel panel-primary">
                    <div class="panel-heading">Friday</div>
                    <table class="table table-striped">
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Module name</th>
                        <th>Lecturer name</th>
                        <?php
                            echo $tablelist[4];
                        ?>
                    </table>
                        </div>
                </form>
            </div>
        </div>
        <iframe src="connectarduino.php" width="500" height="100" frameborder="0">
</iframe>
    </body>
</html>