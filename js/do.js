document.addEventListener('DOMContentLoaded', function(ev) {
    showmore = function(more)
    {
        if (more)
        {
            document.getElementsByClassName("type-list")[0].className = "type-list type-list-slide";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more type-more-on";
        } else {
            document.getElementsByClassName("type-list")[0].className = "type-list";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more";
        }
    }

    document.body.addEventListener("click", function(ev){
        ev = ev || window.event;
        var target = ev.target;

        if("more-type" == target.id)
        {
            var more = cookies('more-type');
            showmore(!more);
            cookies({'more-type': !more});
        }

    }, false);

    Dialogor.OnLoad(".res-links", "iframe");
    var more = cookies('more-type');
    showmore(more);
});