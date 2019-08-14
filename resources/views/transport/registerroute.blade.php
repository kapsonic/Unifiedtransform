@extends('layouts.app')
@section('title', __('Register a route'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Register a route')</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerRoute"
                              action="{{ url('transport/registerroute') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">* @lang('Name')</label>

                                <div class="col-md-6">
                                    <input id="routename" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">* @lang('Source')</label>

                                <div class="col-md-6">
                                    <input id="source" type="text" class="form-control" name="source"
                                           value="{{ old('source') }}" required>

                                    @if ($errors->has('source'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('source') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('startTime') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">* @lang('Start Time')</label>

                                <div class="col-md-6">
                                    <input id="routename" type="text" class="form-control" name="startTime"
                                           value="{{ old('startTime') }}" required>

                                    @if ($errors->has('startTime'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('startTime') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('destination') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">* @lang('Destination')</label>

                                <div class="col-md-6">
                                    <input id="routename" type="text" class="form-control" name="destination"
                                           value="{{ old('destination') }}" required>

                                    @if ($errors->has('destination'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('destination') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('reachTime') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">* @lang('Reach Time')</label>

                                <div class="col-md-6">
                                    <input id="reachTime" type="text" class="form-control" name="reachTime"
                                           value="{{ old('name') }}" required>

                                    @if ($errors->has('reachTime'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('reachTime') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" id="stopsHiddenField" name="stops"/>
                        </form>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#stopModal"
                                dusk="create-stop-button">
                            + @lang('Add Stop')
                        </button>
                        @component('components.route-stops', ['stops'=>[]])
                        @endcomponent
                        <button class="btn btn-primary" type="button" onclick="registerRoute()">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="stopModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="form-horizontal" method="POST" id="stop-add-form">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@lang('Add Stop')</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stopName" class="col-md-4 control-label">* @lang('Stop Name')</label>

                            <div class="col-md-6">
                                <input id="stopName" type="text" class="form-control" name="stopName"
                                       value="{{ old('stopName') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stopAddress" class="col-md-4 control-label">* @lang('Stop Address')</label>

                            <div class="col-md-6">
                                <input id="stopAddress" type="text" class="form-control" name="stopAddress"
                                       value="{{ old('stopAddress') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time" class="col-md-4 control-label">* @lang('Stop Time')</label>

                            <div class="col-md-6">
                                <input id="stopTime" type="text" class="form-control" name="time"
                                       value="{{ old('time') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                        <button type="button" class="btn btn-primary"
                                onclick="addStopToList()">@lang('Add Stop')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        function addStopToList() {
            $("#route-stop-table tbody").append(makeNewRowInStopTable(
                $("#stopName").val(),
                $("#stopAddress").val(),
                $("#stopTime").val()
                )
            );

            $("#stop-add-form").trigger('reset');

        }

        function makeNewRowInStopTable(name, address, time) {
            return "<tr><td>" + name + "</td><td>" + address + "</td><td>" + time + "</td></tr>"
        }

        function registerRoute() {
            var stops = getStopJson();

            $("#stopsHiddenField").val(JSON.stringify(stops));
            console.log("Form serialized ", $("#registerRoute").serialize());
            $("#registerRoute").submit();
        }

        function getStopJson() {
            // Loop through grabbing everything
            var myRows = [];
            var $headers = ["stopName", "stopAddress", "stopTime"];
            var $rows = $("#route-stop-table tbody tr").each(function(index) {
                $cells = $(this).find("td");
                myRows[index] = {};
                $cells.each(function(cellIndex) {
                    myRows[index][$headers[cellIndex]] = $(this).html();
                });
            });
            return myRows
        }
    </script>


@endsection
