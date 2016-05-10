
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

                <a href="/logout" class="btn btn-danger pull-right">Logout</a>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a href="/" aria-controls="todo" role="tab" data-toggle="">To-Do</a></li>
                    <li role="presentation" class="active"><a href="/calender" aria-controls="sync" role="tab" data-toggle="tab">Google Calender</a></li>
                    <li role="presentation"><a href="/#new" aria-controls="new" role="tab" data-toggle="">New</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">


                    {{--Google Calender--}}
                    <div role="tabpanel" class="tab-pane fade in active" id="sync">

                        <div class="container-fluid">

                            <div class="margin-top-20"></div>

                            @if(sizeof($events->getItems()) == 0 )
                                There is no item in your todo list
                            @endif

                            @foreach($events->getItems() as $event)
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $event->id }}" aria-expanded="false" aria-controls="collapse{{ $event->id }}">
                                                            {{ $event->getSummary() }}
                                                        </a>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <h6 class="pull-right">
                                                            {{ date_format(new \DateTime($event->start->dateTime), 'd, M Y @ H:i:s') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $event->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $event->id }}">
                                            <div class="panel-body">
                                                <p>
                                                    {{ $event->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                        <div class="margin-bottom-20"></div>
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
