
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>TODO Application</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/assets/css/todo.css" rel="stylesheet">
</head>

<body>

<div class="container">


    <div class="main">

        <div class="row content">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <h3>Todo List</h3>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#todo" aria-controls="todo" role="tab" data-toggle="tab">To-Do</a></li>
                    <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">New</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    {{--Todo List--}}
                    <div role="tabpanel" class="tab-pane fade in active" id="todo">

                        <div class="container-fluid">

                            <div class="margin-top-20"></div>

                            @if(sizeof($todos) < 1)
                                There is no item in your todo list
                            @endif

                            @foreach($todos as $todo)
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $todo->id }}" aria-expanded="false" aria-controls="collapse{{ $todo->id }}">
                                                            {{ $todo->title }}
                                                        </a>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <h6 class="pull-right">
                                                            {{ date_format(new \DateTime($todo->date), 'D d Y @ H:i:s') }}
                                                        </h6>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <a href="/delete/{{ $todo->id }}" class="pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                                                    </div>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $todo->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <p>
                                                    {{ $todo->info }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="margin-bottom-20"></div>
                    </div>



                    {{--Add new--}}
                    <div role="tabpanel" class="tab-pane fade" id="new">
                        <div class="container-fluid">

                            <div class="margin-top-20"></div>

                            <h3>Add New Item</h3>
                            <form action="/" method="POST" class="form-horizontal">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <div class="input-group date form_datetime" id="date">
                                        <input type="text" class="form-control form_datetime" id="date" name="date" placeholder="Event Date">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="info">Info About Event</label>
                                    <textarea name="info" id="info" class="form-control" rows="10"></textarea>
                                </div>
                                <input type="submit" value="Submit" class="btn btn-info center-block">
                            </form>

                        </div>
                    </div>
                </div>

                <div class="clearfix margin-bottom-20"></div>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>


</div> <!-- /container -->

<script type="text/javascript" src="/assets/js/jquery.min.js"></script>

<script type="text/javascript" src="/assets/js/moment/moment.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(function () {
        $('#date').datetimepicker({
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left"
        });
    });
</script>
</body>
</html>
