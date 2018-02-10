<div id="ticket">
    <form action="" method="post">
        <div id="call-input" class="tick-input">
            <select name="cat" id="cat" class="dropdown cat">
                <option selected disabled value="">Category</option>
            </select>
            <select name="prior" id="priority" class="dropdown priority">
                <option selected disabled value="">Priority</option>
            </select>
            <textarea  id="des" rows="5" placeholder="Description" class="des"></textarea>
            <select name="hard1" id="hard1" class="dropdown ware">
                <option selected disabled value="">Hardware</option>
                <?php 
                    include("config.php");
                    $sql = 'SELECT * FROM Equipment';
                    $conn = new mysqli($DBservername, $DBusername, $DBpassword, $dbname); 
                    $result = $conn->query($sql);
                    if(!$result){
                        cLog("DB Error");
                    } else {
                    while(($row = $result->fetch_assoc())){
                        echo '<option value="'.$row['Serial_Number'].'">'.$row['Serial_Number'].' - '.$row['Type'].'</option>';
                    }
                    }
                ?>
            </select>
            <input type="button" class="plus" value="+"/>
            <select name="soft1" id="soft1" class="dropdown ware">
                <option selected disabled value="">Software</option>
            </select>
            <input type="button" class="plus" value="+"/>
        </div>
        <div class="tick-but">
            <input type="reset" class="reset" value="Reset"/>
            <input type="submit" id="submit-tick" class="next" value="Next"/>
        </div>
    </form>
</div>
<div id="query">
    <form action="" method="post">
        <div id="call-input" class="tick-input">
            <select name="cat" id="cat" class="dropdown cat">
                <option selected disabled value="">Ticket ID</option>
            </select>
            <select name="prior" id="priority" class="dropdown priority">
                <option selected disabled value="">Resolved</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
            <textarea  id="des" rows="5" placeholder="Reason for call/ Solution" class="des"></textarea>
        </div>
        <div class="tick-but">
            <input type="reset" class="reset" value="Reset"/>
            <input type="submit" id="submit-query" class="next" value="Next"/>
        </div>
    </form>
</div>