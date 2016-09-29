<h2>标题：　<?php echo $this->e($title); ?></h2>
<div>
    <p>名字：　<?php echo $this->batch($name,'trim|uppercase');?></p>
    <!--<p>内容：　<?php echo $this->e($content);?></p>-->
    <p>内容：　<?php echo $this->batch($content,'strip_tags|trim');?></p>
</div>