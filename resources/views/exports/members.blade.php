<table>
    <thead>
    <tr style="text-align: center;height: 150px;background-color: #ced0ce">
        <th>Codice Scheda Socio</th>
        <th>Titolo</th>
        <th>Cognome</th>
        <th>Nome</th>
        <th>Data di nascita</th>
        <th>Luogo di nascita</th>
        <th>Codice Fiscale</th>
        <th>Indirizzo email</th>
        <th>Abitazione</th>
        <th>Città</th>
        <th>Cap Città</th>
        <th>PV</th>
        <th>Cellulare</th>
        <th>Sede Lavoro</th>
        <th>Indirizzo Lavoro</th>
        <th>Città Lavoro</th>
        <th>Cap Lavoro</th>
        <th>PV Ufficio</th>
        <th>Telefono Lavoro</th>
        <th>Data iscrizione SID</th>
        <th>Scadenza Tipologia Socio</th>
        <th>Regione di appartenenza</th>
        <th>Tipologia Socio</th>
        <th>Categoria Socio</th>
        <th>Sotto Categoria Socio</th>
        <th>Professione</th>
        <th>Discipline</th>
        <th>Quota Socio</th>
        <th>Quota/e da Pagare</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
        <tr style="text-align: center">
            <td>{{$member->id ?? ''}}</td>
            <td>{{$member->qualification ?? ''}}</td>
            <td>{{$member->surname ?? ''}}</td>
            <td>{{$member->name ?? ''}}</td>
            <td>{{\Illuminate\Support\Carbon::parse($member->birth_date)->format('d-m-Y') ?? ''}}</td>
            <td>{{$member->county->city ?? ''}}</td>
            <td>{{$member->fiscal_code ?? ''}}</td>
            <td>{{$member->email ?? ''}}</td>
            <td>{{$member->residence->residence ?? ''}}</td>
            <td>{{$member->residence->city ?? ''}}</td>
            <td>{{$member->residence->cap ?? ''}}</td>
            <td>{{$member->residence->province ?? ''}}</td>
            <td>{{$member->residence->telephone1 ?? ''}}</td>
            <td>{{$member->job->office ?? ''}}</td>
            <td>{{$member->job->head_quarters ?? ''}}</td>
            <td>{{$member->job->office_city ?? ''}}</td>
            <td>{{$member->job->cap_office_city ?? ''}}</td>
            <td>{{$member->job->province_office_city ?? ''}}</td>
            <td>{{$member->job->telephone3 ?? ''}}</td>
            <td>{{\Illuminate\Support\Carbon::parse($member->position->subscription_date)->format('d-m-Y') ?? ''}}</td>
            <td>{{\Illuminate\Support\Carbon::parse($member->position->expire)->format('d-m-Y') ?? ''}}</td>
            <td>{{$member->position->region->region ?? ''}}</td>
            <td>{{$member->position->member_type ?? ''}}</td>
            <td>{{$member->category->type ?? ''}}</td>
            <td>{{$member->position->sub_category ?? ''}}</td>
            <td>{{$member->position->profession->profession ?? ''}}</td>
            <td>@foreach($member->disciplines as $discipline){{$discipline->discipline}} - @endforeach</td>
            <td>{{$member->payments->last()->amount ?? ''}}</td>
            <td>{{ round(($member->payments->sum('amount') - $member->payments->sum('payed_amount')),2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
