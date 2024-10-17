<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Services\EventService;
use App\Http\Services\FileService;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(
        private EventService $eventService,
        private FileService $fileService
    ){
        $this->middleware('checkRole:operator')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index()
    {
        return view('backend.events.index', [
            'events' => $this->eventService->select(10)
        ]);
    }

    public function create()
    {
        return view('backend.events.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        try {
            $data['image'] = $this->fileService->upload($request->file('image'), 'events');

            Event::create($data);

            return redirect()->route('panel.events.index')->with('success', 'Event created successfully');
        } catch (\Throwable $th) {
            $this->fileService->delete('events/' . $data['image']);
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show(string $uuid)
    {
        return view('backend.events.show', [
            'event' => $this->eventService->selectFirstBy('uuid', $uuid)
        ]);
    }

    public function edit(string $uuid)
    {
        return view('backend.events.edit', [
            'event' => $this->eventService->selectFirstBy('uuid', $uuid)
        ]);
    }

    public function update(EventRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getEvent = $this->eventService->selectFirstBy('uuid', $uuid);

        try {
            if ($request->hasFile('image')) {
                $this->fileService->delete($getEvent->image);
                $data['image'] = $this->fileService->upload($request->file('image'), 'events');
            }

            $getEvent->update($data);

            return redirect()->route('panel.events.index')->with('success', 'Event updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        $event = $this->eventService->selectFirstBy('uuid', $uuid);
        $this->fileService->delete($event->image);
        $event->delete();

        return redirect()->route('panel.events.index')->with('success', 'Event deleted successfully');
    }
}
