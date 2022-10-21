<?php
    require_once __DIR__ . '/config/DB.php';
    $img = 'https://upload.wikimedia.org/wikipedia/commons/3/3f/JPEG_example_flower.jpg';
    header('Content-Type: image/jpeg');
    readfile($img);
?>

<?php

/**
 * Class Banner
 */
class Banner extends DB{

    public $ip;
    public $userAgent;
    public $pageUrl;

    /**
     *  Banner constructor which set params
     */
    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->pageUrl = $_GET['fileName'];
        $this->init();
    }

    /**
     * @return void
     */
    private function init()
    {
       $isNewVisitor = $this->checkIsNewVisitor();
       if (!$isNewVisitor) {
           $this->createNewVisitor();
       } else {
           $this->updateVisitor($isNewVisitor['id'], $isNewVisitor['views_count']);
       }
    }

    /**
     * @param int $id
     * @param int $viewsCount
     * @return void
     */
    private function updateVisitor (int $id, int $viewsCount)
    {
        $count = $viewsCount+1;
        $this->pdo_return_update("
            UPDATE `visitors` SET `view_date`='".date('Y-m-d H:i:s')."',`views_count`= '".$count."' WHERE `id` = '".$id."'
        ");
    }

    /**
     * @return void
     */
    private function createNewVisitor()
    {
        $this->pdo_return_fetch_column(
            "INSERT INTO `visitors`(`ip_address`, `user_agent`, `view_date`, `page_url`, `views_count`)
               VALUES ('".$this->ip."','".$this->userAgent."','".date('Y-m-d H:i:s')."','".$this->pageUrl."',1)"
        );
    }

    /**
     * @return false|mixed
     */
    private function checkIsNewVisitor () {
        $res = $this->pdo_return_fetch_column(
        "SELECT `id`, `views_count` FROM `visitors`
               WHERE `ip_address` = '".$this->ip."'
               AND `user_agent` = '". $this->userAgent."'
               AND `page_url` = '".$this->pageUrl."'"
        );

        if ($res) {
            return $res;
        }

        return false;
    }
}

new Banner();
?>

