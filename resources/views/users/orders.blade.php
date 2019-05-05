@foreach ($tableData_->getData()->data as $row)
    <tr>
        <td>{{  $row->id }}</td>
        <td>{!! $row->status !!}</td>
    </tr>
@endforeach