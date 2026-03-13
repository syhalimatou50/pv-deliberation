@extends('layouts.app')

@section('title', 'Nouvelle Salle')

@section('content')
<div class="card">
    <h1>Nouvelle Salle</h1>
    
    <form action="/salles" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label>Numéro *</label>
            <input type="text" name="numero" required placeholder="ex: A101" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Bâtiment</label>
            <input type="text" name="batiment" placeholder="ex: Bâtiment A" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Capacité *</label>
            <input type="number" name="capacite" required value="30" min="1" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Type *</label>
            <select name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="cours">Salle de Cours</option>
                <option value="td">Salle de TD</option>
                <option value="tp">Salle de TP</option>
                <option value="amphi">Amphithéâtre</option>
                <option value="labo">Laboratoire</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/salles" class="btn">Annuler</a>
    </form>
</div>
@endsection
