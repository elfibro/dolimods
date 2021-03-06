-- ============================================================================
-- Copyright (C) 2011 Laurent Destailleur  <eldy@users.sourceforge.net>
--
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program. If not, see <http://www.gnu.org/licenses/>.
-- ============================================================================


ALTER TABLE llx_submitew_targets_params ADD UNIQUE INDEX idx_submitewtargets_fk_target (fk_target);
ALTER TABLE llx_submitew_targets_params ADD UNIQUE INDEX uk_submitewtargets_params (fk_target, paramkey, paramvalue);

ALTER TABLE llx_submitew_targets_params ADD CONSTRAINT fk_submitewtargets_fk_target FOREIGN KEY (fk_target) REFERENCES llx_submitew_targets(rowid);

