@foreach ($tableData_->getData()->data as $row)
    <tr>
        <td>{{  $row->meal }}</td>
        <td>{{  $row->quantity }}</td>
    </tr>
@endforeach