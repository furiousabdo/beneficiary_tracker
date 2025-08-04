@extends('layouts.app')

@section('title', 'الشجرة العائلية')
@section('header', 'الشجرة العائلية')

@section('content')
<div class="card">
    <div class="card-body">
        <div id="family-tree" class="text-center"></div>
    </div>
</div>

@push('styles')
<style>
    .node {
        display: inline-block;
        margin: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        min-width: 150px;
    }
    .node.family-head {
        background-color: #e3f2fd;
        font-weight: bold;
    }
    .tree {
        text-align: center;
    }
    .tree ul {
        padding-top: 20px;
        position: relative;
        transition: all 0.5s;
    }
    .tree li {
        float: right;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;
        transition: all 0.5s;
    }
    .tree li::before, .tree li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 1px solid #ccc;
        width: 50%;
        height: 20px;
    }
    .tree li::after {
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }
    .tree li:only-child::after, .tree li:only-child::before {
        display: none;
    }
    .tree li:only-child {
        padding-top: 0;
    }
    .tree li:first-child::before, .tree li:last-child::after {
        border: 0 none;
    }
    .tree li:last-child::before {
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
    }
    .tree li:first-child::after {
        border-radius: 5px 0 0 0;
    }
</style>
@endpush

@push('scripts')
<script src="https://d3js.org/d3.v7.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const treeData = {!! $familyTree !!};
        const margin = {top: 20, right: 90, bottom: 30, left: 90};
        const width = 1000 - margin.left - margin.right;
        const height = 500 - margin.top - margin.bottom;

        const svg = d3.select("#family-tree").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);

        const treeLayout = d3.tree().size([height, width]);
        const root = d3.hierarchy(treeData);
        const treeDataProcessed = treeLayout(root);

        // Links
        svg.selectAll(".link")
            .data(treeDataProcessed.links())
            .enter().append("path")
            .attr("class", "link")
            .attr("d", d3.linkHorizontal()
                .x(d => d.y)
                .y(d => d.x));

        // Nodes
        const node = svg.selectAll(".node")
            .data(treeDataProcessed.descendants())
            .enter().append("g")
            .attr("class", d => "node" + (d.data.isFamilyHead ? " family-head" : ""))
            .attr("transform", d => `translate(${d.y},${d.x})`);

        node.append("rect")
            .attr("x", -60)
            .attr("y", -15)
            .attr("width", 120)
            .attr("height", 30)
            .attr("rx", 5)
            .style("fill", d => d.data.isFamilyHead ? "#e3f2fd" : "#fff")
            .style("stroke", "#999");

        node.append("text")
            .attr("dy", ".35em")
            .attr("text-anchor", "middle")
            .text(d => d.data.name)
            .style("font-size", "12px");
    });
</script>
@endpush
@endsection