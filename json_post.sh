#!/bin/bash

# ==========================
# json_post_parallel.sh
# ==========================
# Usage:
# ./json_post_parallel.sh input.json https://example.com/api -j 5
#
# Args:
#   $1 - JSON file (must contain array of objects)
#   $2 - URL to POST to
#   $3 - (optional) parallel jobs, default: 5
#
# Requires: jq, curl, GNU parallel
# ==========================

set -e

INPUT_FILE="$1"
URL="$2"
JOBS="${3:-5}"

if [ -z "$INPUT_FILE" ] || [ -z "$URL" ]; then
  echo "❌ Usage: $0 input.json https://your.api/endpoint [jobs]"
  exit 1
fi

if ! command -v parallel >/dev/null 2>&1; then
  echo "❌ 'parallel' not found. Install it with: sudo apt install parallel OR brew install parallel"
  exit 1
fi

if ! command -v jq >/dev/null 2>&1; then
  echo "❌ 'jq' not found. Install it with: sudo apt install jq OR brew install jq"
  exit 1
fi

echo "📤 Sending JSON POST requests to $URL using $JOBS parallel jobs..."
echo "🗃️ Reading from: $INPUT_FILE"
echo "📝 Logs: responses.log (success), errors.log (failures)"
echo "⏳ ETA and progress below:"
echo ""

# Clear old logs
> responses.log
> errors.log

# Process and send
jq -c '.result[]' "$INPUT_FILE" | parallel -j "$JOBS" --eta '
  start=$(date +%s%3N 2>/dev/null || gdate +%s%3N)
  response=$(echo {} | curl -s -w "\n%{http_code}" -X POST '"$URL"' \
    -H "Content-Type: application/json" \
    -d @-)
  body=$(echo "$response" | head -n1)
  code=$(echo "$response" | tail -n1)
  end=$(date +%s%3N 2>/dev/null || gdate +%s%3N)
  duration=$((end - start))

  if [ "$code" -ge 200 ] && [ "$code" -lt 300 ]; then
    echo "[OK] $code | ${duration}ms | {}" >> responses.log
  else
    echo "[ERR] $code | ${duration}ms | {}" >> errors.log
    echo "[DEBUG] Body: $body" >> errors.log
  fi
'

echo ""
echo "✅ Done. Check responses.log and errors.log."
