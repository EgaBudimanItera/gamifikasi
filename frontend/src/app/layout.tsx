import type { Metadata } from 'next';
import './globals.css';
import ClientLayout from '@/components/layout/ClientLayout';

export const metadata: Metadata = {
  title: 'EduQuest - Gamified Learning Platform',
  description: 'Platform pembelajaran berbasis gamifikasi untuk siswa SMA/SMK',
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id">
      <body>
        <ClientLayout>{children}</ClientLayout>
      </body>
    </html>
  );
}
