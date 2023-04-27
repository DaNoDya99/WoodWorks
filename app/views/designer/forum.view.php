<?php $this->view('designer/includes/header') ?>

<body class="designer">
<?php $this->view('designer/includes/designer_header') ?>
    <div class="forum_body">
        <div class="forum_discussion">
            <div class = "forum_heading">
                <h2 class="add_heading_init">Grade <?=esc($course->grade)?> - <?=esc($course->subject)?></h2>
                <h3 class="mainforum_sub"><?=esc($forummain->subject)?></h3>
                <div class="mainf_des">
                    <!-- changeit to forummain if needed -->
                    <h4 class="mainforum_desc"><?=esc($forummain->description)?></h4>
                </div>
                <?php  if($role == "Teacher" ||$role == "Instructor"):?>
                <button type="button" data-modal-target= "#modal" class="Add_forum" id="Add_forum" >+ Add new discussion</button>
            </div>
            <div class = "add_view">
                <div class="new_discussion" id="new_discussion">
                    <form method= "POST" enctype="multipart/form-data" id="formo" >
                        <label class="forum_subject" for="fsubject"> <label for="Subject" style="color:red;"> *</label> Subject: </label>

                        <p  class="warning" id="err_topic"></p>

                        </br>
                        <input type ="text" name="topic"/></br>
                        <label class="forum_subject" for="fsubject"> <label for="Description" style="color:red;"> *</label>Description: </label>

                        <p  class="warning" id="err_content"></p>

                        </br>
                        <textarea id="descrip" name="content" rows="15" cols="70"></textarea></br></br>
                        <label class="forum_subject" for="fsubject"> Attachments: </label>


                        <p  class="warning" id="err_attachment"></p>

                        <input type ="file" class = "file_attachment" name="attachment" /></br></br>
                        <input type ="submit" id = "submits" name = "submits" class = "home_form_sbt forum_right" value="Submit"/>
                        <input type ="button" class = "home_form_sbt forum_right" value="Cancel" id="forum_cancel"name ="cancel"/>
                    </form>
                </div>
                <?php else:?>
            </div>
            <?php endif;?>

            <table border= 1 class='enq_tbl'>

                <tr>
                    <th>Topic</th>
                    <th>Created by</th>
                    <!-- <th>Last replied</th> -->
                    <th>Date</th>
                    <th>Action</th>
                </tr>

                <?php if(!empty($rows)):?>

                <?php foreach($rows as $row):?>

                <tr>
                    <td><?=esc($row->topic)?></td>

                    <td><?=esc($row->creator)?></td>
                    <!-- <td><?php if($row->last_replied == NULL){echo "-";} else{echo $row->last_replied;}?></td> -->
                    <td><?=esc($row->date)?></td>
                    <td>
                        <div class="enq_view">
                            <a href="<?=ROOT?>/forums/discussion/<?=esc($row->course_id)?>/<?=esc($row->forum_id)?>">

                                <button class="view_enq_btn">View</button>
                            </a>
                            <?php  if($role == "Teacher" ||$role == "Instructor"):?>
                                <button onclick = "deleteForum(<?=esc($row->forum_id)?>)" class="view_enq_btn">Delete</button>
                            <?php endif?>
                        </div>

        </div>
        </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="10">No records found!</td></tr>
        <?php endif;?>
        </table>
    </div>
</body>


</div>
</body>

<script defer src="<?=ROOT?>/assets/javascript/designer/forum.js?v=<?php echo time(); ?>"></script>

