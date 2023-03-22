<table>
    <thead>
    <tr style="height: 50px;">
        <th colspan="2" style="text-align: center !important;">IDENTIFICAZIONE EVENTO</th>
    </tr>
    <tr style="text-align: center;height: 150px;background-color: #ced0ce">
        <th>Codice evento<br>(alfanumerico 20 caretteri)</th>
        <th>Codice edizione<br>(Numerico 2 caratteri)</th>
        <th>Codice organizzatore<br>(Alfanumerico 20 caratteri)</th>
        <th>Codice accreditatore<br>(Rif TABELLA A)</th>
    </tr>
    <tr style="text-align: center">
        <td style="font-weight: bold">{{$course->event_code}}</td>
        <td style="font-weight: bold">{{$course->edition_code}}</td>
        <td style="font-weight: bold">{{$course->organizer_code}}</td>
        <td style="font-weight: bold">{{$course->accreditor_code}}</td>
    </tr>
    <tr>
        <th colspan="10" style="text-align: center">INFORMAZIONI EVENTO</th>
    </tr>
    <tr style="text-align: center">
        <th>Data inizio<br>(aaaa-mm-gg)</th>
        <th>Data fine<br>(aaaa-mm-gg)</th>
        <th>Numero ore<br>(Numerico 3 caratteri)</th>
        <th>Num crediti dell'evento<br>(Num con 2 cifre intere e 1 decimale)</th>
        <th>Tipo formazione<br>(Rif tabella B)</th>
        <th>Formazione a distanza <br>(alfanumerico 1 carattere)</th>
        <th>Formazione a residenziale <br>(Alfanumerico 1 carattere)</th>
        <th>Formazione sul campo <br>(Alfanumerico 1 carattere)</th>
        <th>Tipo evento <br>(Rif TABELLA C)</th>
        <th>Codice Ambito/Obiettivo<br>(Rif TABELLA D)</th>
        <th>Numero partecipanti<br>(Numerico 5 caratteri)</th>
    </tr>
    <tr style="text-align: center">
        <td style="font-weight: bold">{{substr($course->start,0,10)}}</td>
        <td style="font-weight: bold">{{substr($course->end,0,10)}}</td>
        <td>{{$course->course_hours}}</td>
        <td>{{$course->course_credits}}</td>
        <td>{{$course->education}}</td>
        <td>{{$course->fad}}</td>
        <td>{{$course->fre}}</td>
        <td>{{$course->fsc}}</td>
        <td>{{$course->event_type}}</td>
        <td>{{$course->goal_id}}</td>
        <td>{{count($course->frequencies)}}</td>
    </tr>
    <tr>
        <th colspan="3">IDENTIFICAZIONE PROFESSIONISTA</th>
        <th colspan="7">INFORMAZIONE PROFESSIONISTA</th>
    </tr>
    <tr>
        <th>Codice fiscale<br>(Alfanumerico 16 caratteri)</th>
        <th>Nome<br>(Alfanumerico 100 caratteri)</th>
        <th>Cognome<br>(Alfanumerico 100 caratteri)</th>
        <th>Ruolo/Tipo crediti<br>(RIF TABELLA E)</th>
        <th>Libero professionista/Dipendente<br>(Alfanumerico 100 caratteri)</th>
        <th>Sponsor(alfanumerico 100 carattere)</th>
        <th>Crediti acquisiti <br>(Numerico con 2 cifre intere e 1 decimale)</th>
        <th>Data acquisizione crediti <br>(aaaa-mm-gg)</th>
        <th>Professione<br>(Rif TABELLA F)</th>
        <th>Disciplina<br>(RIF TABELLA G)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($course->frequencies as $frequency)
        <tr style="text-align: center">
            <td>{{$frequency->member->fiscal_code ?? ''}}</td>
            <td>{{$frequency->member->name ?? ''}}</td>
            <td>{{$frequency->member->surname ?? ''}}</td>
            <td>@if($frequency->value >= 0 && $frequency->value == $course->course_credits) P @elseif($frequency->value >= 0 && $frequency->value < $course->course_credits) D @endif</td>
            <td>{{$frequency->member->position->jobType->cod_ms ?? ''}}</td>
            <td>{{$frequency->sponsor}}</td>
            <td>{{$frequency->value ?? ''}}</td>
            <td>{{substr($frequency->credits_earned_date,0,10) ?? ''}}</td>
            <td>{{$frequency->member->position->profession->codice_ms ?? ''}}</td>
            <td>
            @foreach($frequency->member->disciplines as $discipline)
                {{$discipline->ms_code ?? ''}}
            @endforeach
            </td>
            <td>{{$frequency->notes ?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
