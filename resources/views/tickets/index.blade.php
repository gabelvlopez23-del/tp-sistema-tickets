<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Tickets</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f3f4f6; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-create { background-color: #16a34a; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-close { background-color: #dc2626; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-edit { background-color: #eab308; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; margin-right: 5px; }
        .success-msg { background-color: #dcfce7; color: #16a34a; padding: 10px; border-radius: 4px; margin-bottom: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background-color: #1f2937; color: white; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .badge-abierto { background-color: #dcfce7; color: #15803d; }
        .badge-cerrado { background-color: #ffeeeb; color: #b91c1c; }
        .actions-cell { display: flex; align-items: center; }
        .nav-management { margin-bottom: 20px; padding: 10px; background: #e5e7eb; border-radius: 4px; }
    </style>
</head>
<body>

<div class="header">
    <h1>Tickets del Sistema</h1>
    
    {{-- Etapa 4: El botón Nuevo Ticket solo aparece si tiene el permiso --}}
    @can('crear tickets')
        <a href="{{ route('tickets.create') }}" class="btn-create">➕ Nuevo Ticket</a>
    @endcan
</div>

@if(session('success'))
    <div class="success-msg">{{ session('success') }}</div>
@endif

{{-- Mostrar link especial si tiene permiso de administrador --}}
@can('gestionar usuarios')
    <div class="nav-management">
        <strong>🔒 Panel Administrativo:</strong> <a href="#">Gestión de Usuarios</a>
    </div>
@endcan

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td><strong>{{ $ticket->titulo }}</strong></td>
                <td>{{ $ticket->user->name }}</td>
                <td>
                    <span class="badge badge-{{ $ticket->estado }}">
                        {{ strtoupper($ticket->estado) }}
                    </span>
                </td>
                <td>
                    <div class="actions-cell">
                        {{-- Botón Editar protegido visualmente --}}
                        @can('editar tickets')
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn-edit">Editar</a>
                        @endcan

                        {{-- Botón Cerrar protegido visualmente --}}
                        @can('cerrar tickets')
                            @if($ticket->estado === 'abierto')
                                <form method="POST" action="{{ route('tickets.cerrar', $ticket) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-close">Cerrar</button>
                                </form>
                            @endif
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
