import React from "react";
import useSWR from "swr";
import api from "./api/api";
import { Lesson } from "../../types";

const fetcher = (url: string) => api.get(url).then((r) => r.data);

export default function Timetable() {
  const { data, error } = useSWR("/mock/timetable", fetcher);

  if (error) return <div>Erreur de chargement</div>;
  if (!data) return <div>Chargement...</div>;

  const lessons: Lesson[] = data;

  return (
    <div className="p-4">
      <h2 className="text-xl font-bold">Emploi du temps</h2>
      <ul>
        {lessons.map((l) => (
          <li key={l.id} className="border p-2 my-2 rounded">
            <div className="font-semibold">{l.subject}</div>
            <div>
              {l.start} — {l.end} • {l.teacher} • {l.room}
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
}
