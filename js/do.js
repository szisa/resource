document.addEventListener('DOMContentLoaded', function(ev) {
    // 显示更多分类
    showmore = function(more)
    {
        if(!document.getElementsByClassName("type-list")[0]) return ;
        if (more)
        {
            document.getElementsByClassName("type-list")[0].className = "type-list type-list-slide";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more type-more-on";
        } else {
            document.getElementsByClassName("type-list")[0].className = "type-list";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more";
        }
    }

    stopPropagation = function(ev){
        ev.preventDefault && ev.preventDefault();
        ev.stopPropagation && ev.stopPropagation();
        ev.cancelBubble = true;
        return false;
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
            cookies({ 'more-type' : !more });
            return stopPropagation(ev);
        }

        // 下载链接点击监听
        if(target.className.indexOf("res-links") >= 0)
        {
            Dialogor.Open({
                title : target.title, 
                type : "iframe", 
                content : target.href
            });
            return stopPropagation(ev);
        }

    }, false);

    // 按照cookies记录开关更多分类
    showmore(cookies('more-type'));
});