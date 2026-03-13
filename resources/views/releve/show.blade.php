@extends('layouts.app')

@section('title', 'Relevé de Notes')

@section('content')
<div class="card">
    <div style="text-align: center; margin-bottom: 2rem; border-bottom: 2px solid #667eea; padding-bottom: 1rem;">
        <h1 style="color: #667eea; margin: 0;">📄 RELEVÉ DE NOTES</h1>
        <h2 style="margin: 0.5rem 0;">{{ $etudiant->prenom }} {{ strtoupper($etudiant->nom) }}</h2>
        <p style="margin: 0.5rem 0;">Matricule : {{ $etudiant->matricule }} | Filière : {{ $etudiant->filiere->nom }}</p>
        <p style="margin: 0; font-size: 0.9rem; color: #666;">Année Académique : {{ $annee_academique }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Matière</th>
                <th>Coefficient</th>
                <th>Note</th>
                <th>Note × Coef</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_notes = 0;
                $total_coef = 0;
            @endphp
            @foreach($notes_detail as $detail)
                @if($detail['moyenne'] !== null)
                    @php
                        $total_notes += $detail['moyenne'] * $detail['matiere']->coefficient;
                        $total_coef += $detail['matiere']->coefficient;
                    @endphp
                    <tr>
                        <td>{{ $detail['matiere']->nom }}</td>
                        <td style="text-align: center;">{{ $detail['matiere']->coefficient }}</td>
                        <td style="text-align: center; font-weight: bold;">{{ number_format($detail['moyenne'], 2) }}/20</td>
                        <td style="text-align: center;">{{ number_format($detail['moyenne'] * $detail['matiere']->coefficient, 2) }}</td>
                    </tr>
                @endif
            @endforeach
            <tr style="background: #f0f0f0; font-weight: bold;">
                <td colspan="2" style="text-align: right;">TOTAL</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">{{ number_format($total_notes, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; text-align: center;">
            <div>
                <h3 style="margin: 0; font-size: 2.5rem;">{{ number_format($moyenne_generale, 2) }}/20</h3>
                <p style="margin: 0.5rem 0 0 0;">Moyenne Générale</p>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 2rem;">{{ $mention }}</h3>
                <p style="margin: 0.5rem 0 0 0;">Mention</p>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 2rem; color: {{ $decision == 'Admis' ? '#2ecc71' : '#e74c3c' }};">{{ $decision }}</h3>
                <p style="margin: 0.5rem 0 0 0;">Décision</p>
            </div>
        </div>
    </div>

    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
        <button onclick="window.print()" class="btn btn-success">🖨️ Imprimer</button>
        <a href="/etudiants" class="btn">← Retour</a>
    </div>
</div>
@endsection
