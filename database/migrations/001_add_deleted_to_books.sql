-- Migration: add 'deleted' column to books for soft-delete
ALTER TABLE books
  ADD COLUMN deleted TINYINT(1) NOT NULL DEFAULT 0;

-- After running this, archived books can be marked with deleted=1
