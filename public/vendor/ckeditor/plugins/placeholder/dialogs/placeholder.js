
/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

/**
 * @fileOverview Definition for placeholder plugin dialog.
 *
 */

'use strict';

CKEDITOR.dialog.add( 'placeholder', function( editor ) {
	var lang = editor.lang.placeholder,
		generalLabel = editor.lang.common.generalTab,
		validNameRegex = /^[^\[\]<>]+$/;

	return {
		title: lang.title,
		minWidth: 300,
		minHeight: 80,
		contents: [
			{
				id: 'info',
				label: generalLabel,
				title: generalLabel,
				elements: [
					// Dialog window UI elements.
					{
						id: 'name',
						type: 'select',
						style: 'width: 100%;',
						label: lang.name,
                        items : [
                            [ 'Agent First Name' ],
                            [ 'Agent Last Name' ],
                            [ 'Agent Full Name' ],
                            [ 'Property Address' ],
                            [ 'Offer Amount' ],
                            [ 'Buyer First Name' ],
                            [ 'Buyer Last Name' ],
                            [ 'Buyer Full Name' ],
                            [ '2nd Buyer First Name' ],
                            [ '2nd Buyer Last Name' ],
                            [ '2nd Buyer Full Name' ],
                            [ 'Down Payment' ],
                        ],
                        'default' : 'Agent First Name',
						required: true,
						validate: CKEDITOR.dialog.validate.regex( validNameRegex, lang.invalidName ),
						setup: function( widget ) {
							this.setValue( widget.data.name );
						},
						commit: function( widget ) {
							widget.setData( 'name', this.getValue() );
						}
					}
				]
			}
		]
	};
} );
