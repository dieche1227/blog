<?php
namespace App\Tools;


/**
 * 自定义分页类,主要用于产生分页试图
 * Class Common
 * @package App\Library
 */
class CustomPage
{
    /**
     * @param $text
     * @return string
     */
    public static function getActivePageWrapper($text)
    {
        return '<li><span>' . $text . '</span></li>';
    }


    /**
     * 获取当前页按钮的页面样式
     * @param $url
     * @param $page
     * @return string
     */
    public static function getActivePageLinkWrapper($url, $page)
    {
        return '<li class="active"><a href="' . $url . '">' . $page . '</a></li>';
    }


    /**
     * 获取非当前页按钮的页面样式
     * @param $url
     * @param $page
     * @return string
     */
    public static function getPageLinkWrapper($url, $page)
    {
        return '<li><a href="' . $url . '">' . $page . '</a></li>';
    }


    /**
     * 获取整个的分页样式
     * @param $nowPage 当前页
     * @param $totalPage 共多少页面
     * @param $baseUrl  当前url
     * @param $search   搜索
     * @return string
     */
    public static function getSelfPageView($nowPage, $totalPage, $baseUrl, $search = [])
    {
        $pagePre = '<ul class="pagination">';
        $pageEnd = '</ul>';

        $pageLastStr = '';
        $pageNextStr = '';
        if ($nowPage <= 1) {
            $nowPage = 1;
            $pageLastStr = '<li class="disabled"><span>«</span></li>';
        }
        if ($nowPage >= $totalPage) {
            $nowPage = $totalPage;
            $pageNextStr = '<li class="disabled"><span>»</span></li>';
        }

        $search['totalPage'] = $totalPage;

        if (empty($pageLastStr)) {
            $lastPage = $nowPage - 1;
            $search['nowPage'] = $lastPage;
            $lastSearchStr = self::arrayToSearchStr($search);
            $url = $baseUrl . '?' . $lastSearchStr;
            $pageLastStr = self::getPageLinkWrapper($url, '«');
        }


        if (empty($pageNextStr)) {
            $pageNext = $nowPage + 1;
            $search['nowPage'] = $pageNext;
            $lastSearchStr = self::arrayToSearchStr($search);
            $url = $baseUrl . '?' . $lastSearchStr;
            $pageNextStr = self::getPageLinkWrapper($url, '»');
        }


        $pageTemp = '';
        $pageRange = self::getPageRange($nowPage, $totalPage);
        $pageTemp .= $pageLastStr;
        foreach ($pageRange as $page) {
            $search['nowPage'] = $page;
            $searchStr = self::arrayToSearchStr($search);
            $url = $baseUrl . '?' . $searchStr;
            if ($page == $nowPage) {
                $pageTemp .= self::getActivePageLinkWrapper($url, $page);
            } else {
                $pageTemp .= self::getPageLinkWrapper($url, $page);
            }
        }
        $pageTemp .= $pageNextStr;
        $pageView = $pagePre . $pageTemp . $pageEnd;
        return $pageView;
    }



        /**
     * 获取实际显示页面范围的范围
     * @param $nowPage
     * @param $totalPage
     * @return array
     */
    public static function getPageRange($nowPage, $totalPage)
    {
        $returnArray = [];

        if ($totalPage <= 5) {
            for ($i = 1; $i <= $totalPage; $i++) {
                $returnArray[] = $i;
            }
        } else {
            $lengthLeft = $nowPage - 1;
            $lengthRight = $totalPage - $nowPage;

            if (($lengthLeft < 2) && ($lengthRight < 2)) {
                $returnArray = [];
            } elseif (($lengthLeft < 2) && ($lengthRight > 2)) {
                for ($i = 1; $i <= 5; $i++) {
                    $returnArray[] = $i;
                }
            } elseif (($lengthLeft > 2) && ($lengthRight < 2)) {
                $start = $totalPage - 4;
                for ($i = $start; $i <= $totalPage; $i++) {
                    $returnArray[] = $i;
                }
            } else {
                for ($i = $nowPage - 2; $i <= $nowPage + 2; $i++) {
                    $returnArray[] = $i;
                }
            }
        }
        return $returnArray;
    }


    /**
     * 将搜索的数组拼接成为url
     * 注意：PHP的内置函数http_build_query，会自动将没有值的参数清除，导致blade模板报错
     * @param $array
     * @return string
     */
    public static function arrayToSearchStr($array)
    {
        $fields_string = '';

        reset($array);
        end($array);
        $lastKey = key($array);
        reset($array);

        foreach ($array as $key => $value) {
            if ($key != $lastKey) {
                $fields_string .= $key . '=' . $value . '&';
            } else {
                $fields_string .= $key . '=' . $value;
            }
        }
        rtrim($fields_string, '&');

        return $fields_string;
    }


    public static function arrayToObject($e)
    {

        if (gettype($e) != 'array') return;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object')
                $e[$k] = (object)self::arrayToObject($v);
        }
        return (object)$e;
    }

    public static function objectToArray($e)
    {
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource') return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)self::objectToArray($v);
        }
        return $e;
    }





    /**
   * 分页处理
   * @param  int     $total     总页数 
   * @param  int     $p         当前页      默认 1
   * @param  string  $pagename  分页变量    默认 p
   * @param  string  $anchor    锚点名称    默认 空
   * @param  integer $pnum      每页显示多少条数据 默认 10 条
   * @param  integer $pagenum   一次显示多少个分页 默认 5
   * @return string  $currenUrl
   */
   public static function page($total, $p = 1, $pnum = 10, $pagenum = 5, $currenUrl, $pagename = 'p',$anchor = '')
   {

        $where = '';
        foreach ($_GET as $key => $va) {
            if($key != $pagename){
                $where[]= $key .'='.$va;
            }
        }
        
        //状态保持
        $urltype = empty($where) ? (empty($currenUrl) ? '?' : $currenUrl . '&') : '?'.implode('&',$where).'&';

        //锚点
        $anchor = empty($anchor) ? '' : '#'.$anchor;

        $maxPage =  ceil($total/$pnum);

        $currentPage = $p+0 <= 0 ? 1 : ($p+0 > $maxPage ? $maxPage : $p+0);
        
        $offsetnum = $pagenum % 2 ==0 ? 1 : 0;

        $offset = floor($pagenum / 2);

        if($maxPage <= $pagenum){
            $start = 1;
            $end = $maxPage;
        }else{
            $start = $currentPage - $offset <= 0 ? 1 : $currentPage - $offset;
            $start = $start + ($offset * 2 ) - $offsetnum >= $maxPage ? $maxPage - ($offset * 2 ) + $offsetnum : $start;
            $endnum = $start + ($offset * 2 ) - $offsetnum;
            $end   = $endnum >= $maxPage ? $maxPage : $endnum;
        }

        //分页显示拼装
        $str ='<ul>';
        //第一个分页否显示 '...'
         $str .=$start > $offset ? "<ul class='cl'><li><a href='{$urltype}p=1{$anchor}'>01...</a></li>" : '<ul>';

        //主体部分分页拼装
        for($i = $start; $i <= $end; $i++){
            $i_str = $i < 10 ? '0'.$i : $i;
            $str .= $currentPage == $i ? "<li><a class='on' href='{$urltype}{$pagename}={$i}{$anchor}'>{$i_str}</a></li>" : "<li><a href='{$urltype}{$pagename}={$i}{$anchor}'>{$i_str}</a></li>";
        }

        //最后一页是否显示 '...'
         $str .=$end < $maxPage ? "<li><a href='{$urltype}{$pagename}={$maxPage}{$anchor}'>...{$maxPage}</a></li>":'';

        //拼装输入框
        
        if($maxPage > $pagenum){
                if(!empty($where)){
                    $str .="<li class='form_page'><form action='' method='get'>";
                    
                    foreach ($where as $mkey => $mvalue) {
                        $va = explode('=', $mvalue);
                        $str .="<input type='hidden' name='".$va[0]."' value='".$va[1]."'/>";
                    }
                   
                    $str .='<input class="page_input" type="text" name="'.$pagename.'"/><input type="submit" style="display:none;" /></form></li>';
                }else{
                    $urlinfo = explode('?', $currenUrl);
                    $str .="<li class='form_page'><form action='".$urlinfo[0]."?{$anchor}' method='get'>";
                    $va = explode('=', $urlinfo[1]);
                    $str .="<input type='hidden' name='".$va[0]."' value='".$va[1]."'/>";
                    $str .='<input class="page_input" type="text" name="'.$pagename.'"/><input type="submit" style="display:none;" /></form></li>';
                }
        }
        
     
       //$str .='<input class="page_input" type="text" name="'.$pagename.'" /><input type="submit" style="display:none;" /></form></li>';
        
        //下页和上一页
        $cpage = $currentPage+1;
        $str .= $currentPage<$maxPage ? "<li class='next'><a href='{$urltype}{$pagename}={$cpage}{$anchor}'><span>下一页</span><i class='icon-next'></i></a></li>":'';
        $cpage = $currentPage-1;
        $str .= $currentPage>1 ? "<li class='pre'><a href='{$urltype}{$pagename}={$cpage}{$anchor}'><i class='icon-prev'></i></a></li>":'';
        $str .= '</ul>';

        //返回处理结果
        return  $str;
    }








}