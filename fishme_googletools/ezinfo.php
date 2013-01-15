<?php
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: fishme_googletools
// SOFTWARE RELEASE: 1.1-0
// COPYRIGHT NOTICE: Copyright (C) 2005-2013 www.fishme.de
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

class fishme_googletoolsInfo
{
    static function info()
    {
        $eZCopyrightString = 'Copyright (C) 2005-' . date('Y') . ' fishme.de';

        return array( 'Name'      => '<a href="https://github.com/fishme/fishme_googletools">fishme_googletools</a> extension',
                      'Version'   => '1.0.5',
                      'Copyright' => $eZCopyrightString,
                      'License'   => 'GNU General Public License v2.0'
                    );
    }
}

?>