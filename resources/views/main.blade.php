@extends('layouts')

{{-- Web site Title --}}
@section('title')
    @parent
    List
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class='page-header'>
            <div class='btn-toolbar pull-right'>
                <div class='btn-group'>
                    <a class='btn btn-primary' href="{{URL::route('project.create')}}">新建项目</a>
                </div>
            </div>
            <h1>Available Projects</h1>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <th>项目名称</th>
                <th>区域</th>
                <th>管理</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!--
        The delete button uses Resftulizer.js to restfully submit with "Delete".  The "action_confirm" class triggers an optional confirm dialog.
        Also, I have hardcoded adding the "disabled" class to the Admin group - deleting your own admin access causes problems.
    -->
@stop

