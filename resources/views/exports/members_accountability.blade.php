<table>
    <thead>
    <tr style="text-align: center;height: 150px;background-color: #ced0ce">
        <th>Titolo</th>
        <th>Cognome</th>
        <th>Nome</th>
        <th>Saldo</th>
        <th>Regione</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
        <tr style="text-align: center">
            <td>{{$member->qualification ?? ''}}</td>
            <td>{{$member->surname ?? ''}}</td>
            <td>{{$member->name ?? ''}}</td>
            <td>{{ round(($member->payments->sum('amount') - $member->payments->sum('payed_amount')),2) }}</td>
            <td>{{ $member->position->region->region ?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
