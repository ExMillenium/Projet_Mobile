export type Role = 'student' | 'teacher' | 'parent' | 'admin';

export interface User {
  id: string;
  name: string;
  role: Role;
  avatarUrl?: string;
}

export interface Lesson {
  id: string;
  subject: string;
  teacher: string;
  start: string;
  end: string;
  room?: string;
}

export interface Grade {
  id: string;
  subject: string;
  value: number;
  coefficient?: number;
  date: string;
  teacher: string;
}