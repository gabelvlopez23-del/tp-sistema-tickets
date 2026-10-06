<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Listar todos los tickets del sistema
    public function index()
    {
        // Seguridad Backend: Si no puede ver tickets, rebota con un error 403
        abort_unless(auth()->user()->can('ver tickets'), 403);

        // Trae los tickets con su usuario relacionado (Eager Loading para optimizar memoria)
        $tickets = Ticket::with('user')->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        abort_unless(auth()->user()->can('crear tickets'), 403);

        return view('tickets.create');
    }

    // Guardar el ticket en la base de datos
    public function store(Request $request)
    {
        abort_unless(auth()->user()->can('crear tickets'), 403);

        // Validamos estrictamente los datos que entran del formulario HTML
        $datos = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
        ]);

        // Insertamos en MySQL vinculándolo al ID del usuario autenticado
        Ticket::create([
            'user_id' => auth()->id(),
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'abierto',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket creado correctamente.');
    }

    // Visualizar un ticket individual en detalle
    public function show(Ticket $ticket)
    {
        abort_unless(auth()->user()->can('ver tickets'), 403);

        return view('tickets.show', compact('ticket'));
    }

    // Mostrar el formulario de edición
    public function edit(Ticket $ticket)
    {
        abort_unless(auth()->user()->can('editar tickets'), 403);

        return view('tickets.edit', compact('ticket'));
    }

    // Procesar los cambios de la edición
    public function update(Request $request, Ticket $ticket)
    {
        abort_unless(auth()->user()->can('editar tickets'), 403);

        $datos = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
        ]);

        $ticket->update($datos);

        return redirect()->route('tickets.index')->with('success', 'Ticket actualizado correctamente.');
    }

    // Acción especializada: Cambiar el estado del ticket a cerrado
    public function cerrar(Ticket $ticket)
    {
        abort_unless(auth()->user()->can('cerrar tickets'), 403);

        $ticket->update([
            'estado' => 'cerrado'
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket cerrado correctamente.');
    }
}
