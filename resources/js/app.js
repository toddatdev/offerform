require('./bootstrap');

import Alpine from 'alpinejs';
import './livewire-sortable';
// import 'livewire-sortable';
import mask from '@alpinejs/mask'
// Livewire sortable
// import '@nextapps-be/livewire-sortablejs';

import videojs from 'video.js';
window.videojs = videojs;
import RecordRTC from 'recordrtc';
window.RecordRTC = RecordRTC;
import Record from 'videojs-record/dist/videojs.record.js';
window.Record = Record;

window.FFmpeg = require('@ffmpeg/ffmpeg');
import FFmpegWasmEngine from "videojs-record/dist/plugins/videojs.record.ffmpeg-wasm.js";
window.FFmpegWasmEngine = FFmpegWasmEngine;

window.videoJsOptions = {
    controls: true,
    autoplay: false,
    fluid: true,
    loop: false,

    bigPlayButton: true,
    controlBar: {
        // volumePanel: false
    },
    plugins: {
        /*
        // wavesurfer section is only needed when recording audio-only
        wavesurfer: {
            backend: 'WebAudio',
            waveColor: '#36393b',
            progressColor: 'black',
            debug: true,
            cursorWidth: 1,
            msDisplayMax: 20,
            hideScrollbar: true,
            displayMilliseconds: true,
            plugins: [
                // enable microphone plugin
                WaveSurfer.microphone.create({
                    bufferSize: 4096,
                    numberOfInputChannels: 1,
                    numberOfOutputChannels: 1,
                    constraints: {
                        video: false,
                        audio: true
                    }
                })
            ]
        },
        */
        record: {
            audio: true,
            video: true,
            maxLength: 530,
            debug: false,
            // enable ffmpeg.js plugin
            // convertEngine: 'ffmpeg.wasm',
            // convertWorkerURL: '/vendor/@ffmpeg/core/dist/ffmpeg-core.js',
            // // convert recorded data to MP3
            // convertOptions: ['-c:v', 'libx264', '-preset', 'slow', '-crf', '22', '-c:a', 'copy', '-f', 'mp4'],
            // // specify output mime-type
            // pluginLibraryOptions: {
            //     outputType: 'video/mp4'
            // },
        }
    }
};


window.Draggable = require('@shopify/draggable');
import SignaturePad from "signature_pad";
window.SignaturePad = SignaturePad;
// IMask
import IMask from "imask";

// CKEditor
import 'ckeditor4';

// Stripe payment method
import {loadStripe} from '@stripe/stripe-js/pure';

// Input masking
import Mask from "@ryangjchandler/alpine-mask";
import "cleave.js/dist/addons/cleave-phone.us";

// Anychart
window.anychart = require('anychart');

window.copy = require('clipboard-copy')

// Google Maps
import {Loader} from 'google-maps';

window.YTPlayer = require('yt-player');

window.googleMaps = new Loader(process.env.MIX_GOOGLE_MAPS_API_KEY, {libraries: ['places']});

window.IMask = IMask;

window.loadStripe = loadStripe;

window.jSuites = require('jsuites');

Alpine.plugin(Mask);
// Alpine.plugin(mask);

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function () {
    $("#demo").on("hide.bs.collapse", function () {
        $(".btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
    });
    $("#demo").on("show.bs.collapse", function () {
        $(".btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
    });
});


window.toggleClickMeToChangeTextInCKEditor = (editor, toggle = 1) => {
    let data = editor.getData();

    let text = '<span style="color:#c67eff !important"><span style="color:black">&nbsp;-&nbsp;</span>CLICK ME TO CHANGE TEXT</span>';
    let closingTag = '</p>';

    if (data.includes('</h3>')) closingTag = '</h3>';
    else if (data.includes('</h4>')) closingTag = '</h4>';
    else if (data.includes('</p>')) closingTag = '</p>';

    if (toggle && !data.includes(text)) {
        // editor.setData(data.replace(closingTag, '') + text);
    } else {
        editor.setData(data.replace(text, ''))
    }
}

window.drawCalculatorChart = (chartData, containerId) => {

    anychart.onDocumentReady(function () {

        // anychart.setLicenceKey("offerform.com-274ab5e2-274c9f1");

        anychart.licenseKey('offerform.com-274ab5e2-274c9f1');

        document.getElementById(containerId).innerHTML = '';

        let data = [...Object.keys(chartData).map((key) => [key, chartData[key]])];

        let chartInstance = anychart.pie(data);

        chartInstance
            .radius('43%')
            .innerRadius('82%');

        let palette = anychart.palettes.distinctColors();

        // set the colors according to the brands
        palette.items([
            {color: '#C67EFF'},
            {color: '#6f62b1'},
            {color: '#2c362b'},
            {color: '#5A1E9A'},
            {color: '#220E33'}
        ]);

        chartInstance.palette(palette);

        // disable the legend of labels
        chartInstance.legend().enabled(false);

        // create a standalone label
        let label = window.anychart.standalones.label();

        // configure the label settings
        label
            .useHtml(true)
            .text(`<span style='color: #313136; font-size:10px;'>Estimated Payment</span><br/><span style = 'color: #313136; font-size:14px;
            font-weight: bold'>
            $${Object.keys(chartData).map(key => parseInt(chartData[key])).reduce((pre, nex) => pre + nex, 0).toLocaleString('en-US', {maximumFractionDigits: 2})}
            </span>`)
            .position('center')
            .anchor('center')
            .hAlign('center')
            .vAlign('middle');

        // set the label as the center content
        chartInstance.center().content(label);

        chartInstance
            .labels()
            // .hAlign('center')
            // .vAlign('middle')
            .position('outside')
            .useHtml(true)
            .format('<span style=\'font-size: 10px\'>{%x}</span><br/><span style=\'font-weight: bold; font-size: 10px\'>${%Value}</span>');

        chartInstance.connectorStroke({color: "#595959", thickness: 1, dash:"1 1"});

        // set container id for the chart
        chartInstance.container(containerId);

        // initiate chart drawing
        chartInstance.draw();

    });
}

$(document).ready(function () {

    $(".pop").popover({ trigger: "manual" , html: true, animation:false})
        .on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
                setTimeout(function () {
                    $(_this).popover('hide');
                }, 1000);

            });
        }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 1000);
    });


});
