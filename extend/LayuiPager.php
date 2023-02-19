<?php

//namespace page;
use think\paginator\driver\Bootstrap;

class LayuiPager extends Bootstrap
{
    public function render()
    {
        if ($this->hasPages()) {
            if ($this->simple) {
                return sprintf(
                    '<div style="text-align: center"><div class="layui-box layui-laypage layui-laypage-default">%s %s</div></div>',
                    $this->getPreviousButton(),
                    $this->getNextButton()
                );
            } else {
                $count = $this->total;
                return sprintf(
                    '<div style="text-align: center"><div class="layui-box layui-laypage layui-laypage-default">%s %s %s %s</div></div>',
                    $this->getPreviousButton(),
                    $this->getLinks(),
                    $this->getNextButton(),
                    "<span>共 {$count} 条记录</span>"
                );
            }
        }
    }

    public $_url;

    function url($page) {
        if (!$this->_url) {
            $pageVar = config('paginate.var_page');
            $get = input('get.');
            unset($get[$pageVar]);
            $get[$pageVar] = '';

            $this->_url = request()->baseUrl().'?' . http_build_query($get);
        }

        return $this->_url . $page;
    }


    /**
     * 生成一个可点击的按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<a href="' . htmlentities($url) . '" data-page="'.$page.'">' . $page . '</a>';
    }

    /**
     * 生成一个激活的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>' . $text . '</em></span>';
    }

    /**
     * 生成一个禁用的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">'.$text.'</a>';
    }
}