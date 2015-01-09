$(document).ready(function() {
    load_tasks();
});

function load_tasks() {
    $.get("db.php?qtype=tasks", function(data) {
        var tasks = data.split('\\n');
        for (i=0; i<tasks.length; i++) {
            if(tasks[i] != '') {
                var fields = tasks[i].split('\\t');
                var the_task = {
                    task_id: fields[0],
                    task_title: fields[1],
                    task_impact: fields[2],
                    task_next_step: fields[3],
                    task_is_important: fields[4],
                    task_is_urgent: fields[5]
                }

                var new_task = $(sprintf('\
                    <div class="task">\
                        <div></div>\
                        <p class="title">%(task_title)s</p>\
                        <p class="next_step">NEXT STEP: <span>%(task_next_step)s</span></p>\
                        <p class="impact">IMPACT: <span>%(task_impact)s</span></p>\
                    </div>\
                ', the_task));

                new_task.css({
                    'border-bottom': '1px solid gray',
                    'cursor': 'pointer'
                });
                new_task.children("div").css({
                    'position': 'absolute',
                    'left': '0px',
                    'height': '100%',
                    'width': '5px',
                    'background-color': 'white'
                })

                new_task.mouseenter(function() {
                    $(this).children('div').css("background-color", "#ea755d");
                });
                new_task.mouseleave(function() {
                   $(this).children('div').css("background-color", "white");
                })

                $('#tasks > div:first-child').append(new_task);
            }
        }
    })
}
