<?php

class Pager
{
    public $links = array();
    public $offset = 0;
    public $page_number = 1;
    public $page_start = 1;
    public $page_end = 1;

    public function __construct($limit = 10,$extras = 1)
    {
        $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;

//        $page_number = isset($_GET['page']) ? (int)$_GET['page']:1;
//        $page_number = $page_number < 1 ? 1:$page_number;
//        $offset = ($page_number - 1) * $limit;

        $this->page_start = $page_number - $extras;
        $this->page_end = $page_number + $extras;

        if($this->page_start<1)
        {
            $this->page_start = 1;
        }

        $this->offset = ($page_number -1)*$limit;
        $this->page_number = $page_number;

        $current_link = ROOT."/".str_replace("url=","",$_SERVER['QUERY_STRING']);

        $current_link = !strstr($current_link,"page=") ? $current_link."&page=1" : $current_link;

        $next_link = preg_replace('/page=[0-9]+/',"page=".($page_number+1),$current_link);
        $first_link = preg_replace('/page=[0-9]+/',"page=1",$current_link);

        $this->links['first'] = $first_link;
        $this->links['current'] = $current_link;
        $this->links['next'] = $next_link;

    }

    public function display()
    {
        ?>
        <div class="pagination">
                <ul>
                    <li><a class="pagination-link" href="<?=$this->links['first']?>">First</a></li>

                    <?php for($x = $this->page_start;$x <= $this->page_end;$x++):?>
                        <li class="<?= $x == $this->page_number ? 'pagination-active' : '' ?>"><a href="
                            <?=preg_replace('/page=[0-9]+/',"page=".$x,$this->links['current']);?>
                        " class="<?=$x == $this->page_number ? 'pagination-link-active' : 'pagination-link' ?>"><?=$x?></a></li>
                    <?php endfor; ?>

                    <li><a class="pagination-link"  href="<?=$this->links['next']?>">Next</a></li>
                </ul>
            </div>
        <?php
    }
}