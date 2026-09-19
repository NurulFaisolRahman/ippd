import json

with open("dataset_extracted.json", "r", encoding="utf-8") as f:
    items = json.load(f)

print(f"Total items: {len(items)}")

# Print a structured tree of Bidang -> Program -> Outcome -> Indikators
tree = {}
for it in items:
    b_key = f"{it['bidang_code']} {it['bidang_nama']}"
    p_key = f"{it['program_code']} {it['program_nama']}"
    o_key = it['outcome_text']
    
    tree.setdefault(b_key, {}).setdefault(p_key, {}).setdefault(o_key, []).append(it)

total_prog = 0
total_ind = 0
for b_key, progs in sorted(tree.items()):
    print(f"\n[BIDANG] {b_key}")
    for p_key, outcomes in sorted(progs.items()):
        total_prog += 1
        print(f"  [PROGRAM] {p_key}")
        for o_key, inds in outcomes.items():
            print(f"    [OUTCOME] {o_key[:80]}")
            for ind in inds:
                total_ind += 1
                print(f"      - {ind['indikator']} | Sat: {ind['satuan']} | Base: {ind['kondisi_awal']} | Tgt26: {ind['target_2026']} | Pagu26: {ind['pagu_2026']} | PD: {ind['perangkat_daerah']}")

print(f"\nSUMMARY: Total Bidang: {len(tree)}, Total Programs: {total_prog}, Total Indicators: {total_ind}")
