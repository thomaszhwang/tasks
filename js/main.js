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
                    <div>\
                        <p>%(task_title)s</p>\
                        <p>%(task_impact)s</p>\
                        <p>%(task_next_step)s</p>\
                    </div>\
                ', the_task));

                new_task.css('border-bottom', '1px solid gray');

                $('#tasks > div:first-child').append(new_task);
            }
        }
    })
}
