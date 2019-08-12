<div class="table-responsive">
  <table id="route-stop-table" class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>

        <th scope="col">@lang('Name')</th>
        <th scope="col">@lang('Address')</th>
        <th scope="col">@lang('Time')</th>
      </tr>
    </thead>
    <tbody>
      @foreach($stops as $stop)
      <tr>

        <td>{{$stop->name}}</td>
        <td>{{$stop->address}}</td>
        <td>{{$stop->time}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
