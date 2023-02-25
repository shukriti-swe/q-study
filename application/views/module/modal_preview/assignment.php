<style>
strong{
    color:#007AC9;
    },
</style>

<strong>Question Info</strong>
<br><br>
<div class="row">
    <div class="col-md-2">
        <p style="color:red !important">Question:</p>
    </div>
    <div class="col-md-9">
        <?php echo  $additionalInfo['question_body']; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <p style="color:red !important">Total mark:</p>
    </div>
    <div class="col-md-9">
        <?php echo  $additionalInfo['totMarks']; ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2" style="margin-right:4px;">
        <p style="color:red !important">Options:</p>
    </div>
    <div class="col-md-9">
        <?php if (isset($additionalInfo['assignment_tasks'])) : ?>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Mark</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($additionalInfo['assignment_tasks'] as $option) : ?>
                        <tr>
                            <td><?php print_r(json_decode($option)->serial) ; ?></td>
                            <td><?php print_r(json_decode($option)->qMark) ; ?></td>
                            <td><?php print_r(json_decode($option)->description) ; ?></td>
                        </tr>
            <?php endforeach; ?>
                        </tbody>
                    </table>



        <?php endif; ?>
    </div>
</div>

<br><br>
<br>
