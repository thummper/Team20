<div id="issue">
    <div id="call-input" class="issue-input">
        <select name="sort" id="incat" class="dropdown cat">
            <option selected disabled value="">Category</option>
            <option value="1">OS</option>
            <option value="2">Software</option>
            <option value="3">Printer</option>
            <option value="4">Hard drive</option>
            <option value="5">...</option>
        </select>
        <select name="sort" id="inpriority" class="dropdown priority">
            <option selected disabled value="">Priority</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <textarea  id="indes" rows="10" placeholder="Description" class="des"></textarea>
        <textarea  id="insoft" rows="3" placeholder="Effected software (item1, item2, ...)" class="soft"></textarea>
        <textarea  id="inhard" rows="3" placeholder="Effected hardware (item1, item2, ...)" class="hard"></textarea>
        <div class="issue-but">
            <input type="submit" class="cancel" value="Cancel" action="action" onclick="window.history.back(); return false;"/>
            <input type="submit" id="mybtn" class="next" value="Next" onclick="nextissue();"/>
        </div>
    </div>
    
</div>
<div id="query">
    <div id="call-input" class="issue-input">
        <input  type="text" name="issueID" id="issueID" class="dropdown cat" placeholder="Issue ID"/>
        <select name="resolved" id="resolved" class="dropdown priority">
            <option selected disabled value="">Resolved</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
        </select>
        <textarea rows="10" placeholder="Reason for Call" class="query"></textarea>
        <div class="issue-but1">
            <input type="submit" class="cancel" value="Cancel" action="action" onclick="window.history.back(); return false;"/>
            <input type="submit" id="mybtn1" class="next" value="Next"/>
        </div>
    </div>
</div>