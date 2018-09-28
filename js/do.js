document.addEventListener('DOMContentLoaded', function(ev) {
    // 显示更多分类
    showmore = function(more)
    {
        if(!document.getElementsByClassName("type-list")[0]) return;
        if (more)
        {
            document.getElementsByClassName("type-list")[0].className = "type-list type-list-slide";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more type-more-on";
        } else {
            document.getElementsByClassName("type-list")[0].className = "type-list";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more";
        }
    }

    // 单击监听
    document.body.addEventListener("click", function(ev){
        ev = ev || window.event;
        var target = ev.target;

        // 更多分类单击监听
        if("more-type" == target.id)
        {
            var more = cookies('more-type');
            showmore(!more);
            cookies({'more-type': !more});
        }

    }, false);

    // 下载链接点击监听
    Dialogor.OnLoad(".res-links", "iframe");
    var more = cookies('more-type');
    showmore(more);
});